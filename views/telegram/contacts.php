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
    <div class="mb-4 flex justify-between items-center">
        <div class="">
            <h1 class="text-2xl font-bold text-gray-800">لیست مخاطبین</h1>
            <span class="text-sm text-gray-600 pb-4">در اینجا لیست مخاطبین شما نمایش داده می‌شود.</span>
        </div>
        <a class="rounded bg-sky-600 text-white text-xs p-3" href="../telegram/telegramContacts.php">بارگیری مخاطبین تلگرام</a>
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
            </tr>
        </thead>
        <tbody id="initial_data" class="border border-dashed border-gray-600">
            <?php
            if (empty($contacts)) : ?>
                <tr>
                    <td colspan="8" class="text-center text-gray-500 p-4 ">هیچ مخاطبی برای نمایش وجود ندارد</td>
                </tr>
                <?php
            else:
                foreach ($contacts as $index => $contact):
                ?>
                    <tr class="">
                        <td class="p-3 text-center"><?= $index + 1 ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['phone']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['username']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['api_bot_id']) ?></td>
                    </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
</section>

<?php if (isset($_GET['success'])) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'عملیات موفقیت آمیز بود',
            text: 'مخاطبین تلگرام با موفقیت بارگیری شدند.',
            confirmButtonText: 'باشه'
        });
    </script>
<?php endif; ?>

<?php require_once '../components/footer.php'; ?>