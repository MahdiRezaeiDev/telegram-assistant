<?php
require_once '../../vendor/autoload.php';
require_once '../../config/constants.php';
require_once '../../database/DB_connect.php';
require_once '../../app/middleware/Authentication.php';
require_once '../../app/middleware/Authorization.php';
require_once '../../utilities/assets/jdf.php';
require_once '../../utilities/helper.php';

use danog\MadelineProto\API;
use danog\MadelineProto\Exception;

$sessionName = getAccountSession(USER_ID);

$MadelineProto = new API($sessionName);
$MadelineProto->start();

try {
    $contacts = $MadelineProto->contacts->getContacts(['hash' => '0']);

    saveContacts($contacts['users'], USER_ID);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

function saveContacts($contacts, $userId)
{
    $checkStmt = DB->prepare("SELECT 1 FROM contacts WHERE api_bot_id = ?");
    $insertStmt = DB->prepare("INSERT INTO contacts (user_id, phone, name, username, api_bot_id) VALUES (?, ?, ?, ?, ?)");

    foreach ($contacts as $contact) {
        $apiBotId = $contact['id'] ?? null;
        if (!$apiBotId) continue;

        $checkStmt->execute([$apiBotId]);
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
    echo '<script>alert("Contacts saved successfully!");</script>';
}

