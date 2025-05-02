<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}
?>
<nav id="main_nav" class="fixed top-0 left-0 right-0 z-50 p-2 flex justify-between bg-white shadow-md">
    <ul class="flex">
        <!-- <li onclick="toggleSidebar()" class="mx-1 px-3 bg-gray-200 hover:bg-gray-400 text-sm font-bold cursor-pointer flex items-center gap-2">
            <img id="open_aside_icon" class="w-6 h-6" src="../../public/icons/menu.svg" alt="menu icon">
        </li> -->
        <li class="mx-1 <?= $category == 'purchase.php' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="./purchase.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                پروفایل کاربری
            </a>
        </li>
        <li class="mx-1 <?= $category == 'purchase.php' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../telegram/contacts.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                لیست مخاطبین
            </a>
        </li>
        <li class="mx-1 <?= $category == 'purchase.php' ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="./purchase.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                لیست کد های فنی
            </a>
        </li>
        <li class="mx-1 <?= $category = "telegram" ? 'bg-gray-400' : 'bg-gray-200' ?> hover:bg-gray-400 text-sm font-bold">
            <a class="p-2 menu_item flex items-center gap-2" href="../telegram/connect.php">
                <!-- <img class="hidden sm:inline-block" src="./assets/icons/add.svg" alt="add icon"> -->
                اتصال به تلگرام
            </a>
        </li>
    </ul>
    <div class="hidden sm:flex items-center">

        <?php
        $profile = '../../public/icons/avatar.svg';
        if (file_exists("../../public/userimg/" . $_SESSION['id'] . ".jpg")) {
            $profile = "../../public/userimg/" . $_SESSION['id'] . ".jpg";
        }
        ?>
        <img class="w-9 h-9 rounded-full border-2 border-gray-900" src="<?= $profile ?>" title="<?= $_SESSION['username'] ?>" alt="user image" />
    </div>
</nav>