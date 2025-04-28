<?php
session_start();
require_once './vendor/autoload.php';

use danog\MadelineProto\API;
use danog\MadelineProto\Exception;
use danog\MadelineProto\Settings\AppInfo;

require_once './config/config.php';

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
            header('Location: verify_password.php');
            exit();
        }

        // If login succeeds, get user info
        $user = $MadelineProto->getSelf();
        if (!$user) {
            throw new Exception('Authentication failed. Please try again.');
        }

        // Save session info
        $_SESSION['user_id'] = $user['id'];

        // Redirect to send message page
        header('Location: send_message.php');
        exit();
    } catch (\danog\MadelineProto\Exception\RPCErrorException $rpcError) {
        // echo 'RPC Error: ' . $rpcError->getMessage();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
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
        <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن کد تایید</h1>
        <form method="post" action="" class="space-y-4">
            <input type="text" name="code" placeholder="کد تایید را وارد کنید" class="w-full p-2 border border-gray-300 rounded-md" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">ورود</button>
        </form>
    </div>
</body>

</html>