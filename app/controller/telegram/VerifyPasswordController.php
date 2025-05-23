<?php

use danog\MadelineProto\API;

if (!isset($_SESSION['phone'])) {
    header('Location: index.php');
    exit();
}

$phone = $_SESSION['phone'];
$sessionName = 'sessions/' . md5($phone);
$MadelineProto = new API($sessionName);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];

    try {
        // Complete the login process with the password for 2FA
        $MadelineProto->complete2falogin($password);

        // Get user info
        $user = $MadelineProto->getSelf();
        if (!$user) {
            throw new Exception('Authentication failed. Please try again.');
        }

        // Save session info
        $_SESSION['user_id'] = $user['id'];
        markAccountAsConnected(USER_ID, $user['id']);

        // Redirect to send message page
        header('Location: ../dashboard/dashboard.php');
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
