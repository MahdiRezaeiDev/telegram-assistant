<?php
$pageTitle = "اتصال به تلگرام";
$category = "telegram";
$iconUrl = 'telegram.svg';
require_once '../components/init.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/VerifyCodeController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<main class="flex flex-col items-center justify-center  bg-gray-100 pt-20">
    <section class="bg-white shadow-md rounded-lg p-6 max-w-md w-full">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن کد تایید</h1>
            <span class="text-sm text-gray-600 pb-4">لطفا کد تایید را که به حساب تلگرام شما ارسال شده است، وارد کنید.</span>
        </div>
        <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" class="space-y-4" onsubmit="handleSubmit(this)">
            <input type="text" name="code" placeholder="کد تایید را وارد کنید" class="w-full p-2 border border-gray-300 rounded" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">ورود</button>
        </form>
    </section>
</main>

<script>
    function handleSubmit(form) {
        const button = form.querySelector('button[type="submit"]');
        button.innerText = 'لطفا صبور باشید...';
        button.disabled = true; // Optional: prevent double-submit
    }
</script>
<?php
require_once '../components/footer.php';
?>