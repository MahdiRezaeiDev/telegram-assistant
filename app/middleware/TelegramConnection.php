<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

if (!isLogin()) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isConnectedToTelegram()) {
    header("Location: ../telegram/connect.php");
    exit;
}
