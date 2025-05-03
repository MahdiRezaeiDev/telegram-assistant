<?php
$pageTitle = "مدیریت کاربران";
$category = "users";
$iconUrl = 'profile.svg';
require_once '../components/header.php';
require_once '../../app/controller/profile/UsersController.php';
require_once "../../layouts/navigation.php";
?>

<div class="min-h-screen bg-gray-100 p-6 flex items-center justify-center">
    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-lg w-full">
        <h2 class="text-xl font-bold text-center text-gray-800 mb-6">ایجاد حساب جدید</h2>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class=" grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام</label>
                <input name="name" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام خانوادگی</label>
                <input name="last_name" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام کاربری</label>
                <input name="username" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                <input name="email" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نوعیت حساب</label>
                <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                    <option value="admin">مدیر</option>
                    <option value="user">کاربر عادی</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شرکت</label>
                <input name="email" type="email" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">رمز عبور</label>
                <input name="password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تکرار رمز عبور</label>
                <input name="confirm_password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium">
                    ایجاد حساب
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../components/footer.php'; ?>