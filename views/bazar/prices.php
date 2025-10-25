<?php
$pageTitle = "قیمت های گرفته شده";
$iconUrl = 'favicon.ico';
require_once '../components/init.php';
require_once '../../app/controller/bazar/AskedPricesController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<div class="container mt-10 p-6 bg-white shadow-lg rounded-xl border border-gray-200 max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">لیست استعلام‌ها</h1>
        <a href="./index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
            + استعلام جدید
        </a>
    </div>

    <div class="overflow-x-auto ">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden text-sm">
            <thead class="bg-blue-50 text-gray-700">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">کد محصول</th>
                    <th class="border px-4 py-2">قیمت</th>
                    <th class="border px-4 py-2">زمان</th>
                    <th class="border px-4 py-2">فروشنده</th>
                    <th class="border px-4 py-2">کاربر</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if (count($prices)): ?>
                    <?php foreach ($prices as $index => $row): ?>
                        <tr class="hover:bg-blue-50 transition">
                            <td class="border px-4 py-2 text-center"><?= $index + 1 ?></td>
                            <td class="border px-4 py-2 font-semibold text-blue-700"><?= htmlspecialchars($row['codename']) ?></td>
                            <td class="border px-4 py-2 text-green-600 font-semibold"><?= htmlspecialchars($row['price']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($row['time']) ?></td>
                            <td class="border px-4 py-2 text-gray-800"><?= htmlspecialchars($row['seller_name']) ?></td>
                            <td class="border px-4 py-2 text-gray-800"><?= htmlspecialchars($row['name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-6">هیچ استعلامی یافت نشد.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../components/footer.php'; ?>