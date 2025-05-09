<?php
$pageTitle = "مدیریت کالاها";
$category = "goods";
$iconUrl = 'goods.svg';
require_once '../../vendor/autoload.php';
require_once '../components/init.php'; 
require_once '../../app/controller/goods/FileController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-2xl space-y-6">
    <h2 class="text-xl font-bold text-gray-800 text-center">📤 آپلود فایل اکسل</h2>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">انتخاب فایل Excel</label>
        <input type="file" name="excel_file" accept=".xlsx,.xls"
            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
            required>
    </div>
    <?php if (isset($file_error)): ?>
        <span class="text-red-500 text-sm"><?= $file_error; ?></span>
    <?php endif; ?>
    <div class="text-sm text-gray-500 mb-4">
        لطفا یک فایل Excel با فرمت .xlsx یا .xls انتخاب کنید.
        <br>فایل باید شامل اطلاعات کالاها باشد.
        <br>اطلاعات باید در ستون‌های مشخص شده قرار گیرد.
        <br>لطفا از فرمت صحیح استفاده کنید.
    </div>
    <div class="text-center">
        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
            بارگذاری و ذخیره در پایگاه داده
        </button>
    </div>
</form>
<script>
    <?php if (isset($success) && $success): ?>
        Swal.fire({
            icon: 'success',
            title: 'عملیات موفقیت آمیز بود',
            html: 'کدهای فنی شما با موفقیت بارگیری شدند. <br><a href="../goods/index.php" class="text-blue-500 underline mt-2 inline-block">بازگشت به صفحه کالاها</a>',
            confirmButtonText: 'باشه'
        });
    <?php endif; ?>
</script>
<?php
require_once '../components/footer.php';
?>