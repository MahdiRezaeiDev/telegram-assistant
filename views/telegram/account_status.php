<?php
$pageTitle = " وضعیت حساب تلگرام";
$category = "telegram";
$iconUrl = 'telegram.svg';
require_once '../components/header.php';
require_once '../../vendor/autoload.php';
require_once "../../layouts/navigation.php";
?>
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="../../public/img/telegram.svg" alt="Telegram" class="w-12 h-12">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">وضعیت حساب تلگرام</h2>
                    <p class="text-sm text-gray-500">اطلاعات مربوط به اتصال و وضعیت حساب</p>
                </div>
            </div>
            <?php if (isAccountConnected(USER['id'])): ?>
                <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                         bg-green-100 text-green-700">
                    فعال
                </span>
            <?php else: ?>
                <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                         bg-red-100 text-red-700">
                    غیرفعال
                </span>
            <?php endif; ?>
        </div>

        <div class="mt-6 space-y-2 text-gray-600 text-sm">
            <p><strong>نام کاربری:</strong> <?= USER['username'] ?></p>
            <p><strong>وضعیت اتصال:</strong> متصل به API</p>
            <p><strong>زمان اتصال:</strong> <span style="direction: ltr !important;"><?= date('Y-m-d', strtotime(USER['created_at'])) ?></span></p>
        </div>

        <div class="mt-6 text-right">
            <?php if (isAccountConnected(USER['id'])): ?>
                <a href="../telegram/disconnect.php" class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                    bg-red-100 hover:bg-red-200 text-red-600 hover:underline">قطع اتصال</a>
            <?php else: ?>
                <a href="../telegram/connect.php" class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                bg-green-100 hover:bg-green-200 text-green-600 hover:underline">اتصال مجدد</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once '../components/footer.php';
?>