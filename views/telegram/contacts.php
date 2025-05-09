<?php
$pageTitle = "مدیریت مخاطبین تلگرام";
$category = "contacts";
$iconUrl = 'contacts.svg';
require_once '../components/init.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/ContactsController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="../../public/img/telegram.svg" alt="Telegram" class="w-12 h-12">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">همه مخاطبین شما</h2>
                    <p class="text-sm text-gray-500">لیست همه مخاطبین شما در تلگرام</p>
                </div>
            </div>
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                         bg-red-100 text-red-700">
                غیرفعال
            </span>
        </div>

        <div class="mt-6 space-y-2 text-gray-600 text-sm">
            <p class="text-center text-xl py-10">
                <strong> این قابلیت به زودی اضافه میشود</strong>
            </p>
        </div>
    </div>
</div>
<?php require_once '../components/footer.php'; ?>