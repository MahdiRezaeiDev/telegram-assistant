<?php
require_once './config/constants.php';
require_once "./database/DB_connect.php";
require_once "./app/middleware/Authentication.php";

if (isLogin()) {
    header("Location: ./views/dashboard/dashboard.php");
    exit;
} else {
    header("Location: ./views/auth/login.php");
    exit;
}
