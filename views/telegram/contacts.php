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
            <tr class="even:bg-gray-100" data-operation="update" data-chat="43416835" data-name=" Morteza" data-username="@mortezaforoghi1" data-profile="http://tel.yadak.center/img/telegram/43416835_x_4.jpg">
                <td class="p-2 text-center">1 </td>
                <td class="p-2 text-center">Morteza</td>
                <td class="p-2 text-center" style="text-decoration:ltr">@mortezaforoghi1</td>
                <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://tel.yadak.center/img/telegram/43416835_x_4.jpg"> </td>
                <td class="p-2 text-center">
                    <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-43416835" data-user="43416835" type="checkbox" name="1" onclick="addPartner(this)">
                </td>

                <td class="p-2 text-center">
                    <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-43416835" data-user="43416835" type="checkbox" name="2" onclick="addPartner(this)">
                </td>

                <td class="p-2 text-center">
                    <input data-section="exist" class="cursor-pointer 
                      exist user-43416835" data-user="43416835" type="checkbox" name="5" onclick="addPartner(this)">
                </td>

                <td class="p-2 text-center">
                    <input data-section="exist" class="cursor-pointer 
                      exist user-43416835" data-user="43416835" type="checkbox" name="14" onclick="addPartner(this)">
                </td>
            </tr>
        </tbody>
    </table>
</section>

<?php require_once '../components/footer.php'; ?>