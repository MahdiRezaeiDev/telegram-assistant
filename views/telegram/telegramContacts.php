<?php
require_once '../../vendor/autoload.php';
require_once '../../config/constants.php';
require_once '../../database/DB_connect.php';
require_once '../../app/middleware/Authentication.php';
require_once '../../app/middleware/Authorization.php';
require_once '../../utilities/assets/jdf.php';
require_once '../../utilities/helper.php';

use danog\MadelineProto\API;

// Initialize session path
$sessionDir = 'sessions';
if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

$sessionName = getAccountSession(USER_ID);
$sessionPath = $sessionDir . '/' . $sessionName;
$sessionConnectionFile = $sessionPath . '/safe.php';

// Redirect if session is missing
if (!file_exists($sessionConnectionFile)) {
    header("Location: ../telegram/connect.php");
    exit;
}

// ⚠️ Handle possible corrupted sessions
try {
    $MadelineProto = new API($sessionPath);
    $MadelineProto->start();

    $user = $MadelineProto->getSelf();
    if (!isset($user['_']) || $user['_'] !== 'user') {
        throw new \Exception("Invalid session type.");
    }
} catch (\Throwable $e) {
    error_log("MadelineProto Error: " . $e->getMessage());

    // Delete corrupted session directory
    deleteSessionDirectory($sessionPath);

    // Redirect to reconnect
    header("Location: ../telegram/connect.php?error=session_corrupted");
    exit;
}

try {
    $contacts = $MadelineProto->channels->getParticipants([
        'channel' => 'https://t.me/+ztzMYQ09O_42OWQ1',
        'filter' => ['_' => 'channelParticipantsRecent'],
        'offset' => 0,
        'limit' => 200,
        'hash' => 0
    ]);

    saveContacts($contacts['users'], USER['user_id'], $MadelineProto);
    header("Location: groupContacts.php?success=1");
} catch (\Throwable $th) {
    error_log("Failed to get participants: " . $th->getMessage());
    die("Could not fetch participants.");
}

// 🧠 Download and return profile photo filename
function getProfilePictureFromPhotoObject($MadelineProto, $photo)
{
    try {
        $directory = './img/telegram';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $fileName = $photo->fileName;
        $filePath = $directory . '/' . $fileName;

        if (file_exists($filePath)) {
            return $fileName;
        }

        $downloaded = $MadelineProto->downloadToDir($photo, $directory);
        return basename($downloaded);
    } catch (\Throwable $e) {
        error_log("Failed to download profile photo: " . $e->getMessage());
        return 'images.png';
    }
}

// 💾 Save contacts to DB
function saveContacts($contacts, $userId, $MadelineProto)
{
    $checkStmt = DB->prepare("SELECT 1 FROM contacts WHERE api_bot_id = ? AND user_id = ?");
    $insertStmt = DB->prepare("INSERT INTO contacts (user_id, phone, name, username, api_bot_id, profile_photo_path) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($contacts as $contact) {
        $apiBotId = $contact['id'] ?? null;
        if (!$apiBotId) continue;

        $checkStmt->execute([$apiBotId, $userId]);
        if ($checkStmt->fetch()) continue;

        $firstName = $contact['first_name'] ?? '';
        $lastName = $contact['last_name'] ?? '';
        $name = trim($firstName . ' ' . $lastName);
        $username = $contact['username'] ?? 'undefined';
        $phone = $contact['phone'] ?? 'undefined';

        $photo = 'images.png';
        try {
            if (!empty($contact['photo'])) {
                $photo = getProfilePictureFromPhotoObject($MadelineProto, $contact['photo']);
            }
        } catch (\Throwable $e) {
            error_log("Photo fetch failed for user $apiBotId: " . $e->getMessage());
        }

        $insertStmt->execute([
            $userId,
            $phone,
            $name,
            $username,
            $apiBotId,
            $photo
        ]);
    }

    $checkStmt->closeCursor();
    $insertStmt->closeCursor();
}

// 🧹 Delete corrupted session folder
function deleteSessionDirectory(string $path): void
{
    if (!is_dir($path)) return;

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($files as $file) {
        $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
    }

    rmdir($path);
}
