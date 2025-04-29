<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

if (!isLogin()) {
    header("Location: ../auth/login.php");
    exit;
}

define('USER_ID', $_SESSION['user_id'] ?? null);
define('USER_NAME', $_SESSION['user_name'] ?? null);
define('USER_ROLE', $_SESSION['role'] ?? null);
define('USER', $_SESSION['user'] ?? null);
