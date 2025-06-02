<?php
$pageTitle = "ویرایش پروفایل";
$category = "profile";
$iconUrl = 'profile.svg';
require_once '../components/init.php';
require_once '../../app/controller/profile/UserAccountController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";

// Example user data (replace with real user from controller)
$user = [
    'name' => $currentUser['name'],
    'last_name' => $currentUser['last_name'],
    'username' => $currentUser['username'],
    'company' => $currentUser['company'],
    'phone' => $currentUser['phone'],
    'address' => $currentUser['address'],
];
?>

<div class="min-h-screen bg-gray-100 p-6 flex items-start gap-5 justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-md w-full">
        <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">ویرایش پروفایل</h2>
        <form class="space-y-5" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام </label>
                <input name="name" type="text" value="<?= $user['name']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام خانوادگی</label>
                <input name="last_name" type="text" value="<?= $user['last_name']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شرکت</label>
                <input name="company" type="text" value="<?= $user['company']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                <input style="direction: ltr !important;" name="phone" type="text" value="<?= $user['phone']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">آدرس</label>
                <input name="address" type="text" value="<?= $user['address']; ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium">
                    ذخیره تغییرات
                </button>
            </div>
        </form>
    </div>
    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full">
        <h2 class="text-xl font-bold text-center text-gray-800 mb-6">ویرایش اطلاعات ورود</h2>
        <form class="space-y-5" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">نام کاربری</label>
                <input name="username" type="text" value="<?= $user['username']; ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <?php if (isset($username_err)): ?>
                    <span class="text-red-500 text-sm"><?= $username_err; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">رمز عبور جدید</label>
                <input name="password" type="password" placeholder="رمز جدید (حداقل 6 کاراکتر)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <?php if (isset($password_err)): ?>
                    <span class="text-red-500 text-sm"><?= $password_err; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تکرار رمز عبور</label>
                <input name="confirm_password" type="password" placeholder="تکرار رمز جدید"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <?php if (isset($confirm_password_err)): ?>
                    <span class="text-red-500 text-sm"><?= $confirm_password_err; ?></span>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium">
                    ذخیره تغییرات
                </button>
            </div>
        </form>
    </div>
</div>
<?php if (isset($_GET['success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'پروفایل با موفقیت ویرایش شد.',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>

<?php require_once '../components/footer.php'; ?>