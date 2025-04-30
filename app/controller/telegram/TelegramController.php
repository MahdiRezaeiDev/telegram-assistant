<?php

use danog\MadelineProto\API;
use danog\MadelineProto\Settings\AppInfo;

if (!isset($DB_NAME)) {
    // If the constant is not defined, it means this file is being accessed directly.
    header("Location: ../../../views/auth/403.php");
}

// Ensure the sessions directory exists
$sessionDir = 'sessions';
$error = null;
if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

// Check if the user is logged in (based on session)
if (isConnectedToTelegram()) {
    header('Location: send_Message.php');
    exit();
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

            print_r(var_dump(isAccountExists($_SESSION['user_id'])));
            if (isAccountExists($_SESSION['id']) && !isAccountConnected($_SESSION['id'])) {
                $error = 'کاربری با این شماره تلفن وجود دارد. لطفا شماره تلفن دیگری وارد کنید.';
                // If the user already exists, update their credentials
                updateTelegramCredentials($apiId, $apiHash, $sessionName, $phone);
            } else {
                // If the user does not exist, save their credentials
                if (!saveTelegramCredentials($apiId, $apiHash, $sessionName, $phone)) {
                    $error = 'کاربری با مشخصات مشابه وجود دارد.';
                    return;
                }
            }

            // Redirect to the code verification page
            header('Location: ./verify_code.php');
            exit();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}


function saveTelegramCredentials($apiId, $apiHash, $sessionName, $phone)
{
    try {
        $sql = "INSERT INTO telegram_credentials (user_id, api_id, api_hash, session_name, phone_number) VALUES (:user_id, :api_id, :api_hash, :session_name, :phone_number)";
        $stmt = DB->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':api_id', $apiId, PDO::PARAM_INT);
        $stmt->bindParam(':api_hash', $apiHash, PDO::PARAM_STR);
        $stmt->bindParam(':session_name', $sessionName, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function updateTelegramCredentials($apiId, $apiHash, $sessionName, $phone)
{
    try {
        $sql = "UPDATE telegram_credentials SET api_id = :api_id, api_hash = :api_hash, session_name = :session_name, phone_number = :phone_number WHERE user_id = :user_id";
        $stmt = DB->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':api_id', $apiId, PDO::PARAM_INT);
        $stmt->bindParam(':api_hash', $apiHash, PDO::PARAM_STR);
        $stmt->bindParam(':session_name', $sessionName, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function deleteTelegramCredentials($userId)
{
    try {
        $sql = "DELETE FROM telegram_credentials WHERE user_id = :user_id";
        $stmt = DB->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
