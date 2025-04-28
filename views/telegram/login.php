<?php
session_start();
require_once './vendor/autoload.php';

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
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به تلگرام</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن اطلاعات</h1>
        <form method="post" action="" class="space-y-4">
            <input type="text" name="api_id" placeholder="API ID" class="w-full p-2 border border-gray-300 rounded-md" required>
            <input type="text" name="api_hash" placeholder="API Hash" class="w-full p-2 border border-gray-300 rounded-md" required>
            <input type="text" name="phone" placeholder="شماره تلفن خود را وارد کنید" class="w-full p-2 border border-gray-300 rounded-md" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">ورود</button>
        </form>
    </div>
</body>

</html>