<?php
$pageTitle = "ویرایش پروفایل";
$category = "profile";
$iconUrl = 'profile.svg';
require_once '../components/header.php';
require_once '../../app/controller/dashboard/DashboardController.php';
require_once "../../layouts/navigation.php";

// Example user data (replace with real user from controller)
$user = [
    'name' => USER['name'],
    'last_name' => USER['last_name'],
    'username' => USER['username'],
    'company' => USER['company'],
    'phone' => USER['phone'],
    'address' => USER['address'],
];
?>

<div class="min-h-screen bg-gray-100 p-6 flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-md w-full">
        <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">ویرایش پروفایل</h2>
        <form action="/profile/update.php" method="POST" enctype="multipart/form-data" class="space-y-5">
            <div class="flex justify-center">
                <img class="w-24 h-24 rounded-full object-cover border-2 border-indigo-400 shadow" src="../../public/icons/avatar.svg" alt="Avatar">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام کامل</label>
                <input name="name" type="text" value="<?= $user['name']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام کامل</label>
                <input name="name" type="text" value="<?= $user['last_name']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام کاربری</label>
                <input style="direction: ltr !important;" name="username" type="text" value="<?= $user['username']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شرکت</label>
                <input name="email" type="email" value="<?= $user['company']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                <input style="direction: ltr !important;" name="phone" type="text" value="<?= $user['phone']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium">
                    ذخیره تغییرات
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../components/footer.php'; ?>