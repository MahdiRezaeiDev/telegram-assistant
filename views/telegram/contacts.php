<?php
$pageTitle = "اتصال به تلگرام";
$category = "telegram";
$iconUrl = 'telegram.svg';
require_once '../components/header.php';
require_once '../../vendor/autoload.php';
require_once '../../app/controller/telegram/ContactsController.php';
require_once "../../layouts/navigation.php";
?>
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
        <tr class="even:bg-gray-100" data-operation="update" data-chat="64938363" data-name=" XXX Samiei" data-username="@SameiZafarghandi" data-profile="http://telegram.yadak.center/img/telegram/64938363_x_4.jpg">
            <td class="p-2 text-center">2 </td>
            <td class="p-2 text-center">XXX Samiei</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@SameiZafarghandi</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/64938363_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-64938363" data-user="64938363" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-64938363" data-user="64938363" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-64938363" data-user="64938363" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-64938363" data-user="64938363" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="75509123" data-name=" XXX Ashkan Rahbari" data-username="@AshkanRahbari68" data-profile="http://telegram.yadak.center/img/telegram/75509123_x_4.jpg">
            <td class="p-2 text-center">3 </td>
            <td class="p-2 text-center">XXX Ashkan Rahbari</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@AshkanRahbari68</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/75509123_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-75509123" data-user="75509123" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-75509123" data-user="75509123" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-75509123" data-user="75509123" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-75509123" data-user="75509123" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="80251850" data-name=" Xxx Siavash" data-username="@KiaRun" data-profile="http://telegram.yadak.center/img/telegram/80251850_x_4.jpg">
            <td class="p-2 text-center">4 </td>
            <td class="p-2 text-center">Xxx Siavash</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@KiaRun</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/80251850_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-80251850" data-user="80251850" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-80251850" data-user="80251850" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-80251850" data-user="80251850" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-80251850" data-user="80251850" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="88594208" data-name=" XXX Shayan" data-username="@shgh84" data-profile="http://telegram.yadak.center/img/telegram/88594208_x_4.jpg">
            <td class="p-2 text-center">5 </td>
            <td class="p-2 text-center">XXX Shayan</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@shgh84</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/88594208_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-88594208" data-user="88594208" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-88594208" data-user="88594208" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-88594208" data-user="88594208" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-88594208" data-user="88594208" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="88808777" data-name=" 888 ashkan" data-username="@Carseen" data-profile="http://telegram.yadak.center/img/telegram/88808777_x_4.jpg">
            <td class="p-2 text-center">6 </td>
            <td class="p-2 text-center">888 ashkan</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Carseen</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/88808777_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-88808777" data-user="88808777" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-88808777" data-user="88808777" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-88808777" data-user="88808777" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-88808777" data-user="88808777" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="91169005" data-name=" XXX Mohammad" data-username="@M_ahmadi11152" data-profile="http://telegram.yadak.center/img/telegram/91169005_x_4.jpg">
            <td class="p-2 text-center">7 </td>
            <td class="p-2 text-center">XXX Mohammad</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@M_ahmadi11152</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/91169005_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-91169005" data-user="91169005" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-91169005" data-user="91169005" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-91169005" data-user="91169005" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-91169005" data-user="91169005" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="92999843" data-name=" Hamkar" data-username="@EHSAN_ASGARI7" data-profile="http://telegram.yadak.center/img/telegram/92999843_x_4.jpg">
            <td class="p-2 text-center">8 </td>
            <td class="p-2 text-center">Hamkar</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@EHSAN_ASGARI7</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/92999843_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-92999843" data-user="92999843" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-92999843" data-user="92999843" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-92999843" data-user="92999843" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-92999843" data-user="92999843" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="98632830" data-name=" XXX Mohsen" data-username="@Mosiii62" data-profile="http://telegram.yadak.center/img/telegram/98632830_x_4.jpg">
            <td class="p-2 text-center">9 </td>
            <td class="p-2 text-center">XXX Mohsen</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Mosiii62</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/98632830_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-98632830" data-user="98632830" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-98632830" data-user="98632830" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-98632830" data-user="98632830" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-98632830" data-user="98632830" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="99791618" data-name=" xxx kamyar" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/99791618_x_4.jpg">
            <td class="p-2 text-center">10 </td>
            <td class="p-2 text-center">xxx kamyar</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/99791618_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-99791618" data-user="99791618" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-99791618" data-user="99791618" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-99791618" data-user="99791618" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-99791618" data-user="99791618" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="105964482" data-name=" XXX Afshin Asadi" data-username="@kia_af" data-profile="http://telegram.yadak.center/img/telegram/105964482_x_4.jpg">
            <td class="p-2 text-center">11 </td>
            <td class="p-2 text-center">XXX Afshin Asadi</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@kia_af</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/105964482_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-105964482" data-user="105964482" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-105964482" data-user="105964482" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-105964482" data-user="105964482" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-105964482" data-user="105964482" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="111236173" data-name=" 999 vahid" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/111236173_x_4.jpg">
            <td class="p-2 text-center">12 </td>
            <td class="p-2 text-center">999 vahid</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/111236173_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-111236173" data-user="111236173" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-111236173" data-user="111236173" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-111236173" data-user="111236173" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-111236173" data-user="111236173" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="114664652" data-name=" xxx Masoud" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/114664652_x_4.jpg">
            <td class="p-2 text-center">13 </td>
            <td class="p-2 text-center">xxx Masoud</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/114664652_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-114664652" data-user="114664652" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-114664652" data-user="114664652" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-114664652" data-user="114664652" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-114664652" data-user="114664652" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="120882109" data-name=" XXX Htm Baran" data-username="@Htm_baran" data-profile="http://telegram.yadak.center/img/telegram/120882109_x_4.jpg">
            <td class="p-2 text-center">14 </td>
            <td class="p-2 text-center">XXX Htm Baran</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Htm_baran</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/120882109_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-120882109" data-user="120882109" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-120882109" data-user="120882109" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-120882109" data-user="120882109" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-120882109" data-user="120882109" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="134810924" data-name=" XXX Nima" data-username="@ariyapartorg" data-profile="http://telegram.yadak.center/img/telegram/134810924_x_4.jpg">
            <td class="p-2 text-center">15 </td>
            <td class="p-2 text-center">XXX Nima</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@ariyapartorg</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/134810924_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-134810924" data-user="134810924" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-134810924" data-user="134810924" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-134810924" data-user="134810924" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-134810924" data-user="134810924" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="220117051" data-name=" 888 foad" data-username="@autogenuine_foad" data-profile="http://new.yadak.center/img/telegram/220117051_x_4.jpg">
            <td class="p-2 text-center">16 </td>
            <td class="p-2 text-center">888 foad</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@autogenuine_foad</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://new.yadak.center/img/telegram/220117051_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-220117051" data-user="220117051" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-220117051" data-user="220117051" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-220117051" data-user="220117051" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-220117051" data-user="220117051" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="246553131" data-name=" xxx" data-username="@mvcoparts1" data-profile="http://telegram.yadak.center/img/telegram/246553131_x_4.jpg">
            <td class="p-2 text-center">17 </td>
            <td class="p-2 text-center">xxx</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@mvcoparts1</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/246553131_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-246553131" data-user="246553131" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-246553131" data-user="246553131" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-246553131" data-user="246553131" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-246553131" data-user="246553131" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="315133766" data-name=" 00 Mehran" data-username="@smehran" data-profile="http://telegram.yadak.center/img/telegram/315133766_x_4.jpg">
            <td class="p-2 text-center">18 </td>
            <td class="p-2 text-center">00 Mehran</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@smehran</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/315133766_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-315133766" data-user="315133766" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-315133766" data-user="315133766" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-315133766" data-user="315133766" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-315133766" data-user="315133766" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="382147570" data-name=" 888 foroshagh" data-username="@hhyundaiyadak" data-profile="http://telegram.yadak.center/img/telegram/382147570_x_4.jpg">
            <td class="p-2 text-center">19 </td>
            <td class="p-2 text-center">888 foroshagh</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@hhyundaiyadak</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/382147570_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-382147570" data-user="382147570" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-382147570" data-user="382147570" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-382147570" data-user="382147570" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-382147570" data-user="382147570" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="484488861" data-name=" 999 sajjad kosha" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/484488861_x_4.jpg">
            <td class="p-2 text-center">20 </td>
            <td class="p-2 text-center">999 sajjad kosha</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/484488861_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-484488861" data-user="484488861" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-484488861" data-user="484488861" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-484488861" data-user="484488861" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-484488861" data-user="484488861" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="748330048" data-name=" xxx mohsen" data-username="@baradaran_hyundai" data-profile="http://telegram.yadak.center/img/telegram/748330048_x_4.jpg">
            <td class="p-2 text-center">21 </td>
            <td class="p-2 text-center">xxx mohsen</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@baradaran_hyundai</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/748330048_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-748330048" data-user="748330048" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-748330048" data-user="748330048" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-748330048" data-user="748330048" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-748330048" data-user="748330048" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="879726731" data-name=" Xxx" data-username="@kiamin09109095149" data-profile="http://telegram.yadak.center/img/telegram/879726731_x_4.jpg">
            <td class="p-2 text-center">22 </td>
            <td class="p-2 text-center">Xxx</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@kiamin09109095149</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/879726731_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-879726731" data-user="879726731" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-879726731" data-user="879726731" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-879726731" data-user="879726731" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-879726731" data-user="879726731" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="988938769" data-name=" xxx mz" data-username="@Part_star_original" data-profile="http://telegram.yadak.center/img/telegram/988938769_x_4.jpg">
            <td class="p-2 text-center">23 </td>
            <td class="p-2 text-center">xxx mz</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Part_star_original</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/988938769_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-988938769" data-user="988938769" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-988938769" data-user="988938769" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-988938769" data-user="988938769" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-988938769" data-user="988938769" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1024252603" data-name=" فروشگاه 110" data-username="@hyundaipartgholami" data-profile="http://telegram.yadak.center/img/telegram/1024252603_x_4.jpg">
            <td class="p-2 text-center">24 </td>
            <td class="p-2 text-center">فروشگاه 110</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@hyundaipartgholami</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/1024252603_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1024252603" data-user="1024252603" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1024252603" data-user="1024252603" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1024252603" data-user="1024252603" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1024252603" data-user="1024252603" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1100089663" data-name=" XXX" data-username="@Tehran_partss" data-profile="http://telegram.yadak.center/img/telegram/1100089663_x_4.jpg">
            <td class="p-2 text-center">25 </td>
            <td class="p-2 text-center">XXX</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Tehran_partss</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/1100089663_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1100089663" data-user="1100089663" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1100089663" data-user="1100089663" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1100089663" data-user="1100089663" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1100089663" data-user="1100089663" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1164302050" data-name=" Homayoon" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/1164302050_x_4.jpg">
            <td class="p-2 text-center">26 </td>
            <td class="p-2 text-center">Homayoon</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/1164302050_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1164302050" data-user="1164302050" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1164302050" data-user="1164302050" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1164302050" data-user="1164302050" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1164302050" data-user="1164302050" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1362829379" data-name=" ایران اتو پارت کارمند رامین فتحعلیان" data-username="@fathalianramin" data-profile="http://telegram.yadak.center/img/telegram/1362829379_x_4.jpg">
            <td class="p-2 text-center">27 </td>
            <td class="p-2 text-center">ایران اتو پارت کارمند رامین فتحعلیان</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@fathalianramin</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/1362829379_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1362829379" data-user="1362829379" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1362829379" data-user="1362829379" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1362829379" data-user="1362829379" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1362829379" data-user="1362829379" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1428504544" data-name=" xxx gorji" data-username="@PERSIAN_PARTS_TRADING" data-profile="http://telegram.yadak.center/img/telegram/1428504544_x_4.jpg">
            <td class="p-2 text-center">28 </td>
            <td class="p-2 text-center">xxx gorji</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@PERSIAN_PARTS_TRADING</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/1428504544_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1428504544" data-user="1428504544" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1428504544" data-user="1428504544" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1428504544" data-user="1428504544" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1428504544" data-user="1428504544" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1456443868" data-name=" Oto kala estelam" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/images.png">
            <td class="p-2 text-center">29 </td>
            <td class="p-2 text-center">Oto kala estelam</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/images.png"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1456443868" data-user="1456443868" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1456443868" data-user="1456443868" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1456443868" data-user="1456443868" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1456443868" data-user="1456443868" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1698916265" data-name=" Bazargani" data-username="@kia_yadak_aria" data-profile="http://new.yadak.center/img/telegram/1698916265_x_4.jpg">
            <td class="p-2 text-center">30 </td>
            <td class="p-2 text-center">Bazargani</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@kia_yadak_aria</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://new.yadak.center/img/telegram/1698916265_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1698916265" data-user="1698916265" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1698916265" data-user="1698916265" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1698916265" data-user="1698916265" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1698916265" data-user="1698916265" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="1869176823" data-name=" xxx bazargani" data-username="@Bazargani_Ahmadi_2021" data-profile="http://telegram.yadak.center/img/telegram/1869176823_x_4.jpg">
            <td class="p-2 text-center">31 </td>
            <td class="p-2 text-center">xxx bazargani</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Bazargani_Ahmadi_2021</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/1869176823_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1869176823" data-user="1869176823" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-1869176823" data-user="1869176823" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1869176823" data-user="1869176823" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-1869176823" data-user="1869176823" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="5217562759" data-name=" javad azimi" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/5217562759_x_4.jpg">
            <td class="p-2 text-center">32 </td>
            <td class="p-2 text-center">javad azimi</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/5217562759_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5217562759" data-user="5217562759" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5217562759" data-user="5217562759" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5217562759" data-user="5217562759" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5217562759" data-user="5217562759" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="5583398676" data-name=" Otokoria dehsaraee" data-username="@Auto_korea2" data-profile="http://telegram.yadak.center/img/telegram/5583398676_x_4.jpg">
            <td class="p-2 text-center">33 </td>
            <td class="p-2 text-center">Otokoria dehsaraee</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Auto_korea2</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/5583398676_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5583398676" data-user="5583398676" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5583398676" data-user="5583398676" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5583398676" data-user="5583398676" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5583398676" data-user="5583398676" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="5692153961" data-name=" سامپارت یدک" data-username="@hyundai_kia_motor" data-profile="http://telegram.yadak.center/img/telegram/5692153961_x_4.jpg">
            <td class="p-2 text-center">34 </td>
            <td class="p-2 text-center">سامپارت یدک</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@hyundai_kia_motor</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/5692153961_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5692153961" data-user="5692153961" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5692153961" data-user="5692153961" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5692153961" data-user="5692153961" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5692153961" data-user="5692153961" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="5782071595" data-name=" Pouya" data-username="@Pouyapartt" data-profile="http://telegram.yadak.center/img/telegram/5782071595_x_4.jpg">
            <td class="p-2 text-center">35 </td>
            <td class="p-2 text-center">Pouya</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Pouyapartt</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/5782071595_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5782071595" data-user="5782071595" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5782071595" data-user="5782071595" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5782071595" data-user="5782071595" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5782071595" data-user="5782071595" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="5800957597" data-name=" Hossein Part Bot" data-username="@Hosein_part_bot" data-profile="http://telegram.yadak.center/img/telegram/5800957597_x_4.jpg">
            <td class="p-2 text-center">36 </td>
            <td class="p-2 text-center">Hossein Part Bot</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Hosein_part_bot</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/5800957597_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5800957597" data-user="5800957597" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-5800957597" data-user="5800957597" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5800957597" data-user="5800957597" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-5800957597" data-user="5800957597" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="6091917729" data-name=" نور پارت" data-username="@Noorparts" data-profile="http://telegram.yadak.center/img/telegram/6091917729_x_4.jpg">
            <td class="p-2 text-center">37 </td>
            <td class="p-2 text-center">نور پارت</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Noorparts</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/6091917729_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-6091917729" data-user="6091917729" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-6091917729" data-user="6091917729" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-6091917729" data-user="6091917729" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-6091917729" data-user="6091917729" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="6235789853" data-name=" مهان پارت (مظفری)" data-username="@mehanpartt" data-profile="http://telegram.yadak.center/img/telegram/6235789853_x_4.jpg">
            <td class="p-2 text-center">38 </td>
            <td class="p-2 text-center">مهان پارت (مظفری)</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@mehanpartt</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/6235789853_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-6235789853" data-user="6235789853" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-6235789853" data-user="6235789853" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-6235789853" data-user="6235789853" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-6235789853" data-user="6235789853" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="7812051619" data-name=" نظری پارتیران" data-username="N/A" data-profile="http://telegram.yadak.center/img/telegram/7812051619_x_4.jpg">
            <td class="p-2 text-center">39 </td>
            <td class="p-2 text-center">نظری پارتیران</td>
            <td class="p-2 text-center" style="text-decoration:ltr">N/A</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/7812051619_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-7812051619" data-user="7812051619" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-7812051619" data-user="7812051619" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-7812051619" data-user="7812051619" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-7812051619" data-user="7812051619" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
        <tr class="even:bg-gray-100" data-operation="update" data-chat="8103306613" data-name=" Bakhtiari" data-username="@Bakhtiarii_shop" data-profile="http://telegram.yadak.center/img/telegram/8103306613_x_4.jpg">
            <td class="p-2 text-center">40 </td>
            <td class="p-2 text-center">Bakhtiari</td>
            <td class="p-2 text-center" style="text-decoration:ltr">@Bakhtiarii_shop</td>
            <td class="p-2 text-center"> <img class="w-8 h-8 rounded-full mx-auto d-block" src="http://telegram.yadak.center/img/telegram/8103306613_x_4.jpg"> </td>
            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-8103306613" data-user="8103306613" type="checkbox" name="1" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-8103306613" data-user="8103306613" type="checkbox" name="2" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input checked="" data-section="exist" class="cursor-pointer 
                      exist user-8103306613" data-user="8103306613" type="checkbox" name="5" onclick="addPartner(this)">
            </td>

            <td class="p-2 text-center">
                <input data-section="exist" class="cursor-pointer 
                      exist user-8103306613" data-user="8103306613" type="checkbox" name="14" onclick="addPartner(this)">
            </td>
        </tr>
    </tbody>
</table>
<?php require_once '../components/footer.php'; ?>