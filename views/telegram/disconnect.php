<?php
require_once '../../vendor/autoload.php';
require_once '../../config/constants.php';
require_once '../../database/DB_connect.php';
require_once '../../app/middleware/Authentication.php';
require_once '../../app/middleware/Authorization.php';
require_once '../../utilities/helper.php';

use danog\MadelineProto\API;

if (isConnectedToTelegram()) {
    $sessionName = getAccountSession(USER_ID);

    $MadelineProto = new API($sessionName);
    // Logout from Telegram
    $MadelineProto->logOut();

    markAccountAsDisconnected(USER_ID);
    deleteFolder($sessionName);

    // Destroy session
    session_destroy();
}

function deleteFolder($folderPath)
{
    if (!is_dir($folderPath)) {
        return false;
    }

    $items = scandir($folderPath);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $itemPath = $folderPath . DIRECTORY_SEPARATOR . $item;

        if (is_dir($itemPath)) {
            deleteFolder($itemPath); // Recursively delete subfolder
        } else {
            unlink($itemPath); // Delete file
        }
    }

    return rmdir($folderPath); // Remove the now-empty folder
}


// // header('Location: index.php');
// // exit();
