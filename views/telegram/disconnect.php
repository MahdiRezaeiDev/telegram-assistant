<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../config/constants.php';
require_once '../database/DB_connect.php';
require_once '../utilities/helper.php';

use danog\MadelineProto\API;

if (isConnectedToTelegram()) {
    $sessionName = getAccountSession(USER_ID);
    $MadelineProto = new API($sessionName);

    // Logout from Telegram
    $MadelineProto->logOut();
    markAccountAsDisconnected(USER_ID);

    // Destroy session
    session_destroy();
}

header('Location: index.php');
exit();
