<?php
$pageTitle = "پروفایل کاربری";
$category = "profile";
$iconUrl = 'profile.svg';
require_once '../components/header.php';
require_once '../../app/controller/dashboard/DashboardController.php';
require_once "../../layouts/navigation.php";
?>

<div class="min-h-screen bg-gray-100 p-6 flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-md w-full">
        <div class="flex flex-col items-center">
            <img class="w-28 h-28 rounded-full object-cover border-4 border-indigo-500 shadow-md" src="/path/to/avatar.jpg" alt="User Avatar">
            <h2 class="mt-4 text-2xl font-bold text-gray-800"><?= USER['name'] . ' ' . USER['last_name'] ?></h2>
            <p class="text-sm text-gray-500 mt-1"><?= USER['username'] ?></p>
        </div>

        <div class="mt-6 space-y-4">
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">ایمیل</span>
                <span class="text-gray-800">user@example.com</span>
            </div>
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">شماره تماس</span>
                <span class="text-gray-800">09123456789</span>
            </div>
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">تاریخ عضویت</span>
                <span class="text-gray-800">1402/01/15</span>
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