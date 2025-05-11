<?php
require_once '../../vendor/autoload.php';
require_once '../../config/constants.php';
require_once '../../database/DB_connect.php';
require_once '../../app/middleware/Authentication.php';
require_once '../../app/middleware/Authorization.php';
require_once '../../utilities/assets/jdf.php';
require_once '../../utilities/helper.php';

use danog\MadelineProto\API;

$sessionName = getAccountSession(USER_ID);

if (!isAccountConnected(USER_ID)) {
    header("Location: ../telegram/connect.php");
    exit;
}

$sessionDir = 'sessions';
if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

$sessionPath = 'sessions/' . $sessionName;
if (!is_dir($sessionPath)) {
    header('Location: connect.php');
} else {
}

try {
    $MadelineProto = new API($sessionPath);
    $MadelineProto->start();

    // This call will throw if not logged in
    $userInfo = $MadelineProto->getSelf();

    if ($userInfo['_'] !== 'user') {
        // Not logged in or invalid session
        header("Location: ../telegram/connect.php");
        exit;
    }
} catch (Exception $e) {
    // Session corrupted or not logged in
    error_log("MadelineProto error: " . $e->getMessage());
    header("Location: ../telegram/connect.php");
    exit;
}

// GETTING ALL THE CONTACTS OF ACCOUNT
// try {
//     $contacts = $MadelineProto->contacts->getContacts(['hash' => '0']);
//     saveContacts($contacts['users'], USER_ID);
//     header("Location: contacts.php?success=1");
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
//     exit;
// }


try {
    $contacts = $MadelineProto->channels->getParticipants([
        'channel' => 'https://t.me/+Z3c56mn7IQ0xNjI0',
        'filter' => ['_' => 'channelParticipantsRecent'], // or 'channelParticipantsAdmins', etc.
        'offset' => 0,
        'limit' => 200,
        'hash' => 0
    ]);
    saveContacts($contacts['users'], USER['user_id']);
    header("Location: groupContacts.php?success=1");
} catch (\Throwable $th) {
    throw $th;
}

function saveContacts($contacts, $userId)
{
    $checkStmt = DB->prepare("SELECT 1 FROM contacts WHERE api_bot_id = ? AND user_id= ?");
    $insertStmt = DB->prepare("INSERT INTO contacts (user_id, phone, name, username, api_bot_id) VALUES (?, ?, ?, ?, ?)");

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

        $insertStmt->execute([
            $userId,
            $contact['phone'] ?? 'undefined',
            $name,
            $contact['username'] ?? 'undefined',
            $apiBotId
        ]);
    }

    $checkStmt->closeCursor();
    $insertStmt->closeCursor();
}
