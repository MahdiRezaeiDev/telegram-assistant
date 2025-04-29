<?php
$pageTitle = "اتصال به تلگرام";
$iconUrl = 'telegram.svg';
require_once '../components/header.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/TelegramController.php';
require_once "../../layouts/navigation.php";
?>
<div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن رمز عبور</h1>
    <form method="post" action="" class="space-y-4">
        <input type="password" name="password" placeholder="رمز عبور خود را وارد کنید" class="w-full p-2 border border-gray-300 rounded-md" required>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">ورود</button>
    </form>
</div>

<?php
require_once '../components/footer.php';
?>