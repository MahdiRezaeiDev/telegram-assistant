<?php
$pageTitle = "پنل مدیریت";
$category = "dashboard";
$iconUrl = 'telegram.svg';
require_once '../components/init.php';
require_once '../../app/controller/dashboard/DashboardController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>

<!-- ------------------------------------------------ Dashboard card section ---------------------------------------------------- -->
<section class="mx-auto px-5 pb-5 bg-gray-100">
    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
        <?php
        if (isAccountExists(USER_ID)):
            if (isConnectedToTelegram()): ?>
                <div class="p-4 transition-shadow bg-green-600 rounded-lg shadow-sm hover:shadow-lg">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col space-y-2">
                            <span class="text-white font-semibold">وضعیت حساب تلگرام</span>
                            <span class="text-xs text-white font-semibold">
                                ارسال پیام خودکار فعال است.
                            </span>
                        </div>
                        <img onclick="toggleContactStatus(1)" title="توقف ارسال پیام خودکار" class="cursor-pointer" src="../../public/icons/power_on.svg" alt="power off icon">
                    </div>
                    <div>
                        <span class="text-xs text-gray-100">برای توقف و از سر گیری ارسال پیام خودکار
                            روی آیکن کلیک کنید.</span>
                    </div>
                </div>
            <?php else: ?>
                <div class="p-4 transition-shadow bg-rose-700 rounded-lg shadow-sm hover:shadow-lg">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col space-y-2">
                            <span class="text-white font-semibold">وضعیت حساب تلگرام</span>
                            <span class="text-xs text-white font-semibold">
                                ارسال پیام خودکار غیرفعال است.
                            </span>
                        </div>
                        <img onclick="toggleContactStatus()" title="توقف ارسال پیام خودکار" class="cursor-pointer" src="../../public/icons/power_off.svg" alt="power off icon">
                    </div>
                    <div>
                        <span class="text-xs text-gray-100">برای توقف و از سر گیری ارسال پیام خودکار
                            روی آیکن کلیک کنید.</span>
                    </div>
                </div>
            <?php endif;
        else:
            ?>
            <div class="p-4 transition-shadow bg-red-600 rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-white font-semibold">وضعیت حساب تلگرام</span>
                        <span class="text-xs text-white font-semibold">
                            حساب تلگرام شما به سامانه متصل نشده است
                        </span>
                    </div>
                </div>
                <div>
                    <a href="../telegram/connect.php" class="text-xs text-blue-100 underline">
                        برای اتصال حساب خود اینجا کلیک نمایید.
                    </a>
                </div>
            </div>
        <?php
        endif; ?>
        <div class="p-4 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-800 font-semibold">مجموع کد های ثبت شده</span>
                    <span class="text-lg font-semibold"><?= $totalGoods ?></span>
                </div>
                <img class="rounded-md w-16 h-16" src="../../public/icons/items.svg" alt="">
            </div>
            <div>
                <a href="../goods/index.php" class="text-blue-500 underline">مشاهده همه</a>
            </div>
        </div>
        <div class="p-4 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-800 font-semibold">مخاطبین</span>
                    <span class="text-lg font-semibold"><?= $totalContacts ?></span>
                </div>
                <img class="rounded-md w-16 h-16" src="../../public/icons/contacts.svg" alt="">
            </div>
            <div>
                <a href="../telegram/contacts.php" class="text-blue-500 underline">مشاهده همه</a>
            </div>
        </div>
        <div class="p-4 transition-shadow bg-white rounded-lg shadow-sm hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-800 font-semibold">اقلام درخواستی امروز</span>
                    <span class="text-lg font-semibold"> 100</span>
                </div>
                <img class="rounded-md w-16 h-16" src="../../public/icons/checked.svg" alt="">
            </div>
            <div>
                <a href="../prices/index.php" class="text-blue-500 underline">مشاهده همه</a>
            </div>
        </div>
    </div>
</section>

<!-- ------------------- DASHBOARD MESSAGES REPORTS SECTION ----------------------------- -->
<section class="mx-auto rtl bg-gray-100 mb-5">
    <div class="grid grid-cols-1 lg:grid-cols-3 px-5 gap-5">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-800 shadow-md hover:shadow-xl">
            <div class="flex items-center justify-between bg-gray-800 p-5">
                <h1 class="text-lg font-semibold text-white">
                    آمار درخواست های یک ساعت اخیر</h1>
                <a href="./requests.php?type=hour" class="text-sm text-blue-500">مشاهده همه</a>
            </div>
            <div class="shadow-md sm:rounded-lg w-full h-full">
                <table class="w-full text-sm text-left rtl:text-center text-gray-800">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                شماره
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                مشتری
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                کدفنی
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                برند
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                قیمت
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lastHourMostRequested as $index => $request) : ?>
                            <tr class="border-b/10 hover:bg-gray-50 even:bg-gray-100">
                                <th class="px-6 py-3  font-semibold text-gray-800 text-center">
                                    <?= ++$index; ?>
                                </th>
                                <th class="px-6 py-3  font-semibold text-gray-800 text-center">
                                    <?= $request['name'] ?>
                                </th>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['part_number'] ?>
                                </td>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['brand'] ?>
                                </td>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['price'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden border border-gray-800 shadow-md hover:shadow-xl">
            <div class="flex items-center justify-between bg-gray-800 p-5">
                <h1 class="text-lg font-semibold text-white">آمار درخواست های امروز
                </h1>
                <a href="./requests.php?type=today" class="text-sm text-blue-500">مشاهده همه</a>
            </div>
            <div class="shadow-md sm:rounded-lg w-full h-full">
                <table class="w-full text-sm text-left rtl:text-center text-gray-800">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                شماره
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                مشتری
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                کدفنی
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                برند
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                قیمت
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($todayMostRequested as $index => $request) : ?>
                            <tr class="border-b/10 hover:bg-gray-50 even:bg-gray-100">
                                <th class="px-6 py-3  font-semibold text-gray-800 text-center">
                                    <?= ++$index; ?>
                                </th>
                                <th class="px-6 py-3  font-semibold text-gray-800 text-center">
                                    <?= $request['name'] ?>
                                </th>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['part_number'] ?>
                                </td>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['brand'] ?>
                                </td>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['price'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden border border-gray-800 shadow-md hover:shadow-xl">
            <div class="flex items-center justify-between bg-gray-800 p-5">
                <h1 class="text-lg font-semibold text-white">آمار درخواست های کلی</h1>
                <a href="./requests.php?type=all" class="text-sm text-blue-500">مشاهده همه</a>
            </div>
            <div class="shadow-md sm:rounded-lg w-full h-full">
                <table class="w-full text-sm text-left rtl:text-center text-gray-800">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                شماره
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                مشتری
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                کدفنی
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                برند
                            </th>
                            <th scope="col" class="font-semibold text-sm text-center text-gray-800 px-6 py-3">
                                قیمت
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($allTimeMostRequested as $index => $request) : ?>
                            <tr class="border-b/10 hover:bg-gray-50 even:bg-gray-100">
                                <th class="px-6 py-3  font-semibold text-gray-800 text-center">
                                    <?= ++$index; ?>
                                </th>
                                <th class="px-6 py-3  font-semibold text-gray-800 text-center">
                                    <?= $request['name'] ?>
                                </th>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['part_number'] ?>
                                </td>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['brand'] ?>
                                </td>
                                <td class="px-6 py-3  font-semibold text-center text-gray-800">
                                    <?= $request['price'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    const contactApi = "../../app/api/telegram/ContactsApi.php";

    function toggleStatus(status) {
        var params = new URLSearchParams();
        params.append('toggleStatus', 'toggleStatus');
        params.append('status', status);

        axios
            .post(contactApi, params)
            .then(function(response) {
                const data = response.data;
                window.location.reload();
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function toggleContactStatus(contactId, isBlocked) {
        var params = new URLSearchParams();
        params.append('action', 'toggleContactStatus');
        params.append('user_id', <?= USER_ID ?>);

        axios
            .post(contactApi, params)
            .then(function(response) {
                const data = response.data;
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    console.error(data.message);
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>
<?php
require_once '../components/footer.php';
?>