<?php
$pageTitle = "مدیریت کاربران";
$category = "users";
$iconUrl = 'profile.svg';
require_once '../components/header.php';
require_once '../../app/controller/profile/UsersController.php';
require_once "../../layouts/navigation.php";
?>
<section class="shadow-md rounded-lg p-6 w-full">
    <div class="mb-4 flex justify-between items-center">
        <div class="">
            <h1 class="text-2xl font-bold text-gray-800">لیست کاربران</h1>
            <span class="text-sm text-gray-600 pb-4">در اینجا لیست کاربران شما نمایش داده می‌شود.</span>
        </div>
        <input type="search" name="search" id="search" placeholder="جستجو..."
            onkeyup="searchContacts(this.value)"
            class="rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>
    <table class="table-fixed w-full">
        <thead class="sticky_nav sticky bg-gray-800 border border-gray-600">
            <tr>
                <th scope="col" class="text-white font-semibold p-3 text-center w-8">
                    #
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    نام نام خانوادگی
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    نام کاربری
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    شماره تماس
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    شناسه یکتا
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    آدرس
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    <img class="mx-auto" src="../../public/icons/setting.svg" alt="settings">
                </th>
            </tr>
        </thead>
        <tbody id="initial_data" class="border border-dashed border-gray-600">
            <?php if (empty($users)) : ?>
                <tr>
                    <td colspan="6" class="text-center text-gray-500 p-4 ">هیچ مخاطبی برای نمایش وجود ندارد</td>
                </tr>
                <?php
            else:
                foreach ($users as $index => $user): ?>
                    <tr class="even:bg-gray-100 odd:bg-white hover:bg-gray-200 transition duration-300">
                        <td class="p-3 text-center"><?= $index + 1 ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($user['name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($user['last_name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($user['phone']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($user['company']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($user['address']) ?></td>
                        <td class="p-3 text-center">
                            <img src="../../public/icons/delete.svg" alt="delete icon" class="w-5 h-5 cursor-pointer mx-auto"
                                onclick="deleteUser(<?= $user['id'] ?>)" title="حذف کاربر" />
                        </td>
                    </tr>
            <?php
                endforeach;
            endif; ?>
        </tbody>
    </table>
</section>
<script>
        function searchContacts(query) {
        const initialData = document.getElementById('initial_data');
        const rows = initialData.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 1; j < cells.length; j++) { // Start from 1 to skip the first cell
                if (cells[j].innerText.toLowerCase().includes(query.toLowerCase())) {
                    found = true;
                    break;
                }
            }
            rows[i].style.display = found ? '' : 'none';
        }
    }
</script>
<?php require_once '../components/footer.php'; ?>