<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

function isLogin()
{
    if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] !== true) {
        return false; // Return false if not set or not true
    }

    if (isLoginSessionExpired()) {
        return false; // Return false if session expired
    }

    return true; // Otherwise, logged in
}


function isLoginSessionExpired()
{
    // Check if the session has expired (current time > expiration time)
    if (isset($_SESSION["expiration_time"]) && time() > $_SESSION["expiration_time"]) {
        return true;
    }
    return false;
}
