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
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    انسداد شماره
                </th>
            </tr>
        </thead>
        <tbody id="initial_data" class="border border-dashed border-gray-600">
            <?php if (empty($contacts)) : ?>
                <tr>
                    <td colspan="8" class="text-center text-gray-500 p-4 ">هیچ مخاطبی برای نمایش وجود ندارد</td>
                </tr>
                <?php
            else:
                foreach ($contacts as $index => $contact): ?>
                    <tr class="even:bg-gray-100 odd:bg-white hover:bg-gray-200 transition duration-300">
                        <td class="p-3 text-center"><?= $index + 1 ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['phone']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['username']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($contact['api_bot_id']) ?></td>
                        <td class="p-3 text-center">
                            <input
                                onclick="updateContactStatus(<?= $contact['id'] ?>, this.checked)"
                                type="checkbox" name="blocked" id="blocked"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                <?= $contact['is_blocked'] ? 'checked' : '' ?>>
                        </td>
                    </tr>
            <?php
                endforeach;
            endif; ?>
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
<script>
    function updateContactStatus(contactId, isBlocked) {
        const params = new URLSearchParams();
        params.append('action', 'updateContactStatus');
        params.append('contactId', contactId);
        params.append('isBlocked', isBlocked ? 1 : 0);

        axios.post('../../app/api/telegram/ContactsApi.php', params)
            .then(function(response) {
                console.log(response.data);
                if (response.data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'عملیات موفقیت آمیز بود',
                        text: 'وضعیت مخاطب با موفقیت به روز شد.',
                        confirmButtonText: 'باشه'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا در به روز رسانی',
                        text: response.data.message,
                        confirmButtonText: 'باشه'
                    });
                }
            })
    }
</script>

<?php require_once '../components/footer.php'; ?>