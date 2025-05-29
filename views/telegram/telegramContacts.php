<?php
require_once '../../vendor/autoload.php';
require_once '../../config/constants.php';
require_once '../../database/DB_connect.php';
require_once '../../app/middleware/Authentication.php';
require_once '../../app/middleware/Authorization.php';
require_once '../../utilities/assets/jdf.php';
require_once '../../utilities/helper.php';

use danog\MadelineProto\API;

$sessionDir = 'sessions';
if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

$sessionFile = 'sessions/' . getAccountSession(USER_ID);
$sessionConnectionFile = 'sessions/' . getAccountSession(USER_ID) . '/safe.php';

if (!file_exists($sessionConnectionFile)) {
    // No session file — redirect to login/connect
    header("Location: ../telegram/connect.php");
    exit;
}

try {
    try {
        // ✅ Correctly use the session for this account
        $MadelineProto = new API($sessionFile);
        $MadelineProto->start();
    } catch (\Throwable $th) {
        echo "❌ Failed to start session for user_id {$account['user_id']}: " . $th->getMessage();
    }

    $user = $MadelineProto->getSelf();

    if (!isset($user['_']) || $user['_'] !== 'user') {
        // Not a valid user session
        header("Location: ../telegram/connect.php");
        exit;
    }
} catch (Exception $e) {
    // Invalid or expired session
    error_log("MadelineProto Error: " . $e->getMessage());
    // header("Location: ../telegram/connect.php");
    exit;
}

try {
    $contacts = $MadelineProto->channels->getParticipants([
        'channel' => 'https://t.me/+Z3c56mn7IQ0xNjI0',
        'filter' => ['_' => 'channelParticipantsRecent'], // or 'channelParticipantsAdmins', etc.
        'offset' => 0,
        'limit' => 200,
        'hash' => 0
    ]);
    saveContacts($contacts['users'], USER['user_id'], $MadelineProto);
    header("Location: groupContacts.php?success=1");
} catch (\Throwable $th) {
    throw $th;
}

function saveContacts($contacts, $userId, $MadelineProto)
{
    global $MadelineProto;

    $checkStmt = DB->prepare("SELECT 1 FROM contacts WHERE api_bot_id = ? AND user_id= ?");
    $insertStmt = DB->prepare("INSERT INTO contacts (user_id, phone, name, username, api_bot_id, profile_photo_path) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($contacts as $contact) {
        $apiBotId = $contact['id'] ?? null;
        if (!$apiBotId) continue;

        $checkStmt->execute([$apiBotId, $userId]);
        if ($checkStmt->fetch()) {
            continue; // Skip if already exists
        }

        $firstName = $contact['first_name'] ?? '';
        $lastName = $contact['last_name'] ?? '';
        $name = trim($firstName . ' ' . $lastName);

        // Download profile photo if available
        $photoPath = null;
        if (!empty($contact['photo'])) {
            try {
                $path = 'profile_photos/' . $apiBotId . '.jpg';
                if (!is_dir('profile_photos')) {
                    mkdir('profile_photos', 0777, true);
                }

                $MadelineProto->downloadProfilePhoto([
                    'peer' => $contact,
                    'file' => $path
                ]);
                $photoPath = $path;
            } catch (\Throwable $e) {
                error_log("Photo download failed for user {$apiBotId}: " . $e->getMessage());
                $photoPath = null;
            }
        }

        $insertStmt->execute([
            $userId,
            $contact['phone'] ?? 'undefined',
            $name,
            $contact['username'] ?? 'undefined',
            $apiBotId,
            $photoPath
        ]);
    }

    $checkStmt->closeCursor();
    $insertStmt->closeCursor();
}
