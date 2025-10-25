<?php
$pageTitle = "مدیریت مخاطبین تلگرام";
$category = "telegramGroupContacts";
$iconUrl = 'contacts.svg';
require_once '../components/init.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/ContactsController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<section class="shadow-md rounded-lg p-6 w-full overflow-x-auto min-h-screen">
    <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-2 justify-between items-center">
        <div class="">
            <h1 class="text-2xl font-bold text-gray-800">لیست مخاطبین</h1>
            <span class="text-sm text-gray-600 pb-4">در اینجا لیست مخاطبین شما نمایش داده می‌شود.</span>
        </div>
        <input type="search" name="search" id="search" placeholder="جستجو..."
            onkeyup="searchContacts(this.value)"
            class="rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <div class="flex justify-end">
            <a id="uploadContacts" class="rounded bg-sky-600 text-white text-xs text-center p-3 w-full md:w-40" href="../telegram/telegramContacts.php">بارگیری مخاطبین تلگرام</a>
        </div>
    </div>
    <table class="w-full">
        <thead class="sticky_nav sticky bg-gray-800 border border-gray-600">
            <tr>
                <th scope="col" class="text-white font-semibold p-3 text-center w-8">
                    #
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    نام نام خانوادگی
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    شماره تماس
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    نام کاربری
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    شناسه یکتا
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    پروفایل
                </th>
                <th scope="col" class="text-white font-semibold p-3 text-center">
                    جلوگیری از ارسال پیام
                </th>
            </tr>
        </thead>
        <tbody id="initial_data" class="border border-dashed border-gray-600">
            <?php if (empty($contacts)) : ?>
                <tr>
                    <td colspan="6" class="text-center text-gray-500 p-4 ">هیچ مخاطبی برای نمایش وجود ندارد</td>
                </tr>
                <?php
            else:
                foreach ($contacts as $index => $contact): ?>
                    <tr class="even:bg-gray-100 odd:bg-white hover:bg-gray-200 transition duration-300">
                        <td class="p-3 text-center"><?= $index + 1 ?></td>
                        <td class="p-3 text-center"><?= ($contact['name']) ?></td>
                        <td class="p-3 text-center"><?= ($contact['phone']) ?></td>
                        <td class="p-3 text-center"><?= ($contact['username']) ?></td>
                        <td class="p-3 text-center"><?= ($contact['api_bot_id']) ?></td>
                        <td class="p-3 text-center">
                            <img class="rounded-full w-8 h-8 mx-auto" src="https://telegram.cheraghbargh.ir/views/telegram/profile_photos/user_<?= $contact['api_bot_id'] ?>.jpg" alt="" srcset="">
                        </td>
                        <td class="p-3 text-center">
                            <input
                                onclick="updateContactStatus(<?= $contact['id'] ?>, this.checked)"
                                type="checkbox" name="blocked"
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

    const uploadContacts = document.getElementById("uploadContacts");

    uploadContacts.addEventListener('click', (event) => {
        event.target.innerText = "لطفا صبور باشید..."
    })
</script>

<?php require_once '../components/footer.php'; ?>