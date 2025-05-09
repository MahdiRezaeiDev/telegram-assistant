<?php
$pageTitle = "پروفایل کاربری";
$category = "profile";
$iconUrl = 'profile.svg';
require_once '../components/init.php';
require_once '../../app/controller/dashboard/DashboardController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>

<div class="min-h-screen bg-gray-100 p-6 flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-md w-full">
        <div class="flex flex-col items-center">
            <img class="w-28 h-28 rounded-full object-cover border-4 border-indigo-500 shadow-md" src="../../public/icons/avatar.svg" alt="User Avatar">
            <h2 class="mt-4 text-2xl font-bold text-gray-800"><?= USER['name'] . ' ' . USER['last_name'] ?></h2>
            <p class="text-sm text-gray-500 mt-1"><?= USER['username'] ?></p>
        </div>

        <div class="mt-6 space-y-4">
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">شرکت</span>
                <span class="text-gray-800"><?= USER['company'] ?></span>
            </div>
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">شماره تماس</span>
                <span class="text-gray-800" style="direction: ltr !important;"><?= USER['phone'] ?></span>
            </div>
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">تاریخ عضویت</span>
                <span class="text-gray-800" style="direction: ltr !important;"><?= date('Y-m-d', strtotime(USER['created_at'])) ?></span>
            </div>
        </div>

        <div class="mt-6">
            <a href="./edit.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
                ویرایش پروفایل
            </a>
        </div>
    </div>
</div>

<?php require_once '../components/footer.php'; ?>