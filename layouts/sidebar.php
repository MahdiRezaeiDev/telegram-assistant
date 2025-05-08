<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}
$fileName = basename($_SERVER['PHP_SELF']);
?>
<aside id="side_bar">
    <ul>
        <li style="display: flex; justify-content: end;">
            <img src="../../public/icons/close.svg" class="cursor-pointer w-5 h-5 ml-3 mt-4" alt="close menu icon" onclick="toggleSidebar()">
        </li>
        <li class="mx-1 <?= $category == 'dashboard' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../dashboard/dashboard.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                داشبورد
            </a>
        </li>
        <?php if (USER['role'] == 'admin'): ?>
            <li class="mx-1 <?= $category == 'users' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
                <a class="p-2 menu_item flex items-center gap-2" href="../profile/list.php">
                    <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                    مدیریت کاربران
                </a>
            </li>
        <?php endif; ?>
        <li class="mx-1 <?= $category == 'profile' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../profile/index.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                پروفایل کاربری
            </a>
        </li>
        <li class="mx-1 <?= $category == 'telegramGroupContacts' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../telegram/GroupContacts.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                لیست مخاطبین چراغ برق
            </a>
        </li>
        <li class="mx-1 <?= $category == 'contacts' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../telegram/contacts.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                همه مخاطبین
            </a>
        </li>
        <li class="mx-1 <?= $category == 'goods' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../goods/index.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                لیست کد های فنی
            </a>
        </li>
        <li class="mx-1 <?= $category == "telegram" ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../telegram/connect.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                اتصال به تلگرام
            </a>
        </li>
    </ul>
    <ul>
        <li>
            <a class="flex justify-start items-center gap-2 p-4 hover:bg-gray-200 text-sm font-semibold" href="../auth/logout.php">
                <img src="./assets/icons/power.svg" alt="save icon">
                خروج از حساب کاربری
            </a>
        </li>
    </ul>
</aside>