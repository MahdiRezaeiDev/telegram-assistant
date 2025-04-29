<?php
$pageTitle = "اتصال به تلگرام";
$iconUrl = 'telegram.svg';
require_once '../components/header.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/VerifyCodeController.php';
require_once "../../layouts/navigation.php";
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به تلگرام</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن کد تایید</h1>
        <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" class="space-y-4">
            <input type="text" name="code" placeholder="کد تایید را وارد کنید" class="w-full p-2 border border-gray-300 rounded-md" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">ورود</button>
        </form>
    </div>
</body>

</html>