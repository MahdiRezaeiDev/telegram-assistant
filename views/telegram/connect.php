<?php
$pageTitle = "اتصال به تلگرام";
$category = "telegram";
$iconUrl = 'telegram.svg';
require_once '../components/init.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/TelegramController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<main class="flex flex-col items-center justify-center  bg-gray-100 pt-20">
    <section class="bg-white shadow-md rounded-lg p-6 max-w-md w-full">
        
        <?php if(isset($_GET['error'])): ?>
            <div class=" mx-5 bg-rose-600 text-red text-xs text-center rounded bg-gray-200 p-3 mb-5">
                اتصال قبلی شما دچار مشکل شده است، لطفا دوباره متصل شوید.
            </div>
        <?php endif; ?>
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">وارد کردن اطلاعات</h1>
            <span class="text-sm text-gray-600 pb-4">لطفا اطلاعات زیر را وارد کنید تا به حساب تلگرام خود متصل شوید.</span>
        </div>
        <form id="form" method="post" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" class="space-y-4">
            <input style="direction: ltr !important;" type="text" name="api_id" placeholder="API ID" class="w-full p-2 border border-gray-300 rounded" required>
            <input style="direction: ltr !important;" type="text" name="api_hash" placeholder="API Hash" class="w-full p-2 border border-gray-300 rounded" required>
            <input style="direction: ltr !important;" type="text" name="phone" placeholder="شماره تلفن خود را وارد کنید" class="w-full p-2 border border-gray-300 rounded" required>
            <?php if (isset($error)) : ?>
                <div class="text-red-500 text-sm mt-2"><?= $error ?></div>
            <?php endif; ?>
            <button onclick="loading(this)" type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                اتص‍ال به تلگرام
            </button>
        </form>
    </section>
</main>
<script>
    function loading(element, loadingText = 'لطفا صبور باشید...') {
        document.getElementById('form').submit();
        element.setAttribute('disabled', true);

        // Save original text to restore later if needed
        element.dataset.originalText = element.innerHTML;

        // Optional: Add spinner + loading text
        element.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>${loadingText}`;
    }
</script>
<?php
require_once '../components/footer.php';
?>