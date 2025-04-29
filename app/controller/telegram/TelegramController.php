<?php
if (!isset($dbname)) {
    header("Location: ../../../views/auth/403.php");
}

use danog\MadelineProto\API;
use danog\MadelineProto\Settings\AppInfo;

// Ensure the sessions directory exists
$sessionDir = 'sessions';
if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $apiId = $_POST['api_id'];
    $apiHash = $_POST['api_hash'];
    $phone = $_POST['phone'];

    if (!empty($apiId) && !empty($apiHash) && !empty($phone)) {
        // Save API credentials and phone number in session
        $_SESSION['api_id'] = $apiId;
        $_SESSION['api_hash'] = $apiHash;
        $_SESSION['phone'] = $phone;

        // Generate a unique session name for the user
        $sessionName = $sessionDir . DIRECTORY_SEPARATOR . md5($phone);

        // Define the settings using AppInfo
        $settings = new AppInfo([
            'api_id' => (int)$apiId,
            'api_hash' => $apiHash,
        ]);

        try {
            $MadelineProto = new API($sessionName, $settings);
            $MadelineProto->phoneLogin($phone);

            // Redirect to the code verification page
            header('Location: verify_code.php');
            exit();
        } catch (Exception $e) {
            print_r($_SESSION);
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Please provide all required information.';
    }
}

// Check if the user is logged in (based on session)
if (isset($_SESSION['api_hash'])) {
    header('Location: send_Message.php');
    exit();
}