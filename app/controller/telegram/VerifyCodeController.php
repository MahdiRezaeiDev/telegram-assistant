<?php

use danog\MadelineProto\API;
use danog\MadelineProto\Exception;
use danog\MadelineProto\Settings\AppInfo;

if (!isset($DB_NAME)) {
    // If the constant is not defined, it means this file is being accessed directly.
    header("Location: ../../../views/auth/403.php");
}

if (!isset($_SESSION['phone']) || !isset($_SESSION['api_id']) || !isset($_SESSION['api_hash'])) {
    header('Location: index.php');
    exit();
}

$phone = $_SESSION['phone'];
$apiId = $_SESSION['api_id'];
$apiHash = $_SESSION['api_hash'];

// Session path
$sessionName = 'sessions' . DIRECTORY_SEPARATOR . md5($phone);

// Initialize MadelineProto
$settings = new AppInfo([
    'api_id' => (int)$apiId,
    'api_hash' => $apiHash,
]);

try {
    $MadelineProto = new API($sessionName, $settings);
} catch (Exception $e) {
    die('Error initializing MadelineProto: ' . $e->getMessage());
}

// Handle the verification code
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['code'])) {
    $code = $_POST['code'];

    try {
        // Complete the login process with the code
        $authorizationState = $MadelineProto->completePhoneLogin($code);

        // Check if a password is required for 2FA
        if ($authorizationState['_'] === 'auth.authorizationSignUpRequired') {
            throw new Exception('This phone number is not registered with Telegram.');
        }

        if ($authorizationState['_'] === 'account.password') {
            // Redirect to password input page
            $_SESSION['auth_password_required'] = true;
            header('Location: ./verify_password.php');
            exit();
        }

        // If login succeeds, get user info
        $user = $MadelineProto->getSelf();
        if (!$user) {
            throw new Exception('Authentication failed. Please try again.');
        }

        // Save session info
        $_SESSION['user_id'] = $user['id'];
        markAccountAsConnected(USER_ID,  $user['id']);

        // Redirect to send message page
        header('Location: ../dashboard/dashboard.php');
        exit();
    } catch (Exception $e) {
         $msg = $e->getMessage();

        if (stripos($msg, 'PHONE_CODE_INVALID') !== false) {
            $errorMessage = "کد وارد شده نادرست است. لطفاً کد جدید را درخواست کنید.";
        } elseif (stripos($msg, 'PHONE_CODE_EXPIRED') !== false) {
            $errorMessage = "کد منقضی شده است. لطفاً کد جدیدی درخواست کنید.";
        } else {
            $errorMessage = "خطایی رخ داده است: " . htmlspecialchars($msg);
        }
    }
}