<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

if (!isLogin()) {
    header("Location: ../auth/login.php");
    exit;
}

define('USER', $_SESSION['user'] ?? null);
define('USER_ID', $_SESSION['user']['user_id'] ?? null);
define('USER_NAME', $_SESSION['user_name'] ?? null);
define('USER_ROLE', $_SESSION['role'] ?? null);
