<?php
$pageTitle = "اتصال به تلگرام";
$category = "telegram";
$iconUrl = 'telegram.svg';
require_once '../components/header.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/ContactsController.php';
require_once "../../layouts/navigation.php";
?>
<section class="shadow-md rounded-lg p-6 w-full">
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-800">لیست مخاطبین</h1>
        <span class="text-sm text-gray-600 pb-4">در اینجا لیست مخاطبین شما نمایش داده می‌شود.</span>
    </div>
    <table class="table-fixed w-full">
        <thead class="sticky_nav sticky bg-gray-800 border border-gray-600">
            <tr>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    شماره
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    نام
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    نام کاربری
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    پروفایل
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    هیوندای </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    کیا </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    چینی </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    i20 </th>
            </tr>
        </thead>
        <tbody id="initial_data" class="border border-dashed border-gray-600">
            <?php
            if (empty($contacts)) {
                echo '<tr><td colspan="8" class="text-center text-gray-500 p-4 ">هیچ مخاطبی برای نمایش وجود ندارد</td></tr>';
            } else {
                foreach ($contacts as $contact) {
                    echo '<tr class="border-b border-gray-600 hover:bg-gray-700">';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['phone_number']) . '</td>';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['first_name']) . '</td>';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['username']) . '</td>';
                    echo '<td class="p-3 text-center"><a href="' . htmlspecialchars($contact['profile_url']) . '" target="_blank">مشاهده</a></td>';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['hyundai']) . '</td>';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['kia']) . '</td>';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['chinese']) . '</td>';
                    echo '<td class="p-3 text-center">' . htmlspecialchars($contact['i20']) . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</section>

<?php require_once '../components/footer.php'; ?>