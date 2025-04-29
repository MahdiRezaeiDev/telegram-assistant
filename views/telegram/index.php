<?php
$pageTitle = "اتصال به تلگرام";
$iconUrl = 'telegram.svg';
require_once '../components/header.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/TelegramController.php';
require_once "../../layouts/navigation.php";
?>
<main class="flex flex-col items-center justify-center  bg-gray-100 pt-20">
    <section class="bg-white shadow-md rounded-lg p-6 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">وارد کردن اطلاعات</h1>
        <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" class="space-y-4">
            <input type="text" name="api_id" placeholder="API ID" class="w-full p-2 border border-gray-300 rounded-md" required>
            <input type="text" name="api_hash" placeholder="API Hash" class="w-full p-2 border border-gray-300 rounded-md" required>
            <input type="text" name="phone" placeholder="شماره تلفن خود را وارد کنید" class="w-full p-2 border border-gray-300 rounded-md" required>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">ورود</button>
        </form>
    </section>
</main>
<script>
    function isLoading() {
        const loading = document.getElementById('loading');
        loading.classList.toggle('hidden');
    }
</script>
<?php
require_once '../components/footer.php';
?>