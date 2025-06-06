<?php
require_once '../../vendor/autoload.php';
require_once '../../config/constants.php';
require_once '../../database/DB_connect.php';
require_once '../../app/middleware/Authentication.php';
require_once '../../app/middleware/Authorization.php';
require_once '../../utilities/helper.php';

use danog\MadelineProto\API;

if (isConnectedToTelegram()) {
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

    $MadelineProto = new API($sessionFile);
    // Logout from Telegram
    $MadelineProto->logOut();
    markAccountAsDisconnected(USER_ID);
    // deleteFolder($sessionFile);
    header("Location: ../telegram/connect.php");
    exit();
}

function deleteFolder($folderPath)
{
    if (!is_dir($folderPath)) {
        return false;
    }

    // Try to read contents
    $items = @scandir($folderPath);
    if ($items === false) {
        return false;
    }

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $itemPath = $folderPath . DIRECTORY_SEPARATOR . $item;

        if (is_dir($itemPath)) {
            deleteFolder($itemPath); // Recursively delete subfolder
        } else {
            @unlink($itemPath); // Suppress warnings when deleting files
        }
    }

    return @rmdir($folderPath); // Suppress warnings on rmdir
}

function deleteTelegramCredentials($userId)
{
    $sql = "DELETE FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}
