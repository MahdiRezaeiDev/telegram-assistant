<?php
$pageTitle = "مدیریت کاربران";
$category = "users";
$iconUrl = 'profile.svg';
require_once '../components/header.php';
require_once '../../app/controller/profile/AccountController.php';
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
                <?php if (isset($name_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($name_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام خانوادگی</label>
                <input name="last_name" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                <?php if (isset($last_name_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($last_name_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام کاربری</label>
                <input name="username" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                <?php if (isset($username_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($username_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                <input name="phone" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                <?php if (isset($phone_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($phone_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نوعیت حساب</label>
                <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                    <option value="admin">مدیر</option>
                    <option value="user">کاربر عادی</option>
                </select>
                <?php if (isset($role_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($role_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شرکت</label>
                <input name="company" type="text" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                <?php if (isset($company_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($company_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">رمز عبور</label>
                <input name="password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                <?php if (isset($password_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($password_err) ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تکرار رمز عبور</label>
                <input name="confirm_password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:outline-none">
                <?php if (isset($confirm_password_err)): ?>
                    <span class="text-red-500 text-sm"><?= htmlspecialchars($confirm_password_err) ?></span>
                <?php endif; ?>
            </div>
            <div class="">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium">
                    ایجاد حساب
                </button>
            </div>
        </form>
        <?php if (isset($error)) : ?>
            <div class="mt-4 text-red-500 text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../components/footer.php'; ?>