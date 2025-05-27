<?php
$pageTitle = "مدیریت کالاها";
$category = "goods";
$iconUrl = 'goods.svg';
require_once '../components/init.php';
require_once '../../app/controller/goods/FileController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";

$goods = getAllGoods(); // Assuming this function fetches the goods list from the database
?>
<section class="shadow-md rounded-lg p-6 w-full">
    <div class="w-full overflow-x-auto min-h-screen">
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="">
                <h1 class="text-2xl font-bold text-gray-800">لیست کدهای فنی اضافه شده</h1>
                <span class="text-sm text-gray-600 pb-4">در اینجا لیست کدهای فنی اضافه شده توسط شما نمایش داده می‌شود.</span>
            </div>
            <input type="search" name="search" id="search" placeholder="جستجو..."
                onkeyup="searchGoods(this.value)"
                class="rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 items-center" />
            <div class="flex justify-end items-center gap-2">
                <a class="rounded bg-sky-600 text-white text-xs p-3" href="../goods/upload.php">آپلود فایل کد های فنی</a>

                <button class="rounded bg-red-600 text-white text-xs p-3 flex items-center gap-2"
                    onclick="deleteAllGoods()">
                    حذف همه کدهای فنی
                </button>
            </div>

        </div>
        <table class="w-full">
            <thead class="bg-gray-800 border border-gray-600">
                <tr>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center w-8">
                        #
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        کد فنی
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        کد مشابه
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        برند
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        قیمت
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        توضیحات
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        اجازه ربات
                    </th>
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        ارسال بدون قیمت
                    </th>
                    <!-- <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        ارسال با قیمت
                    </th> -->
                    <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                        عملیات
                    </th>
                </tr>
            </thead>
            <tbody id="initial_data" class="border border-dashed border-gray-600">
                <?php if (empty($goods)) : ?>
                    <tr>
                        <td colspan="9" class="text-center text-gray-500 p-4 ">هیچ کدفنی برای نمایش وجود ندارد</td>
                    </tr>
                    <?php
                else:
                    foreach ($goods as $index => $good):
                        $similarCodes = array_column(getSimilarGoods($good['id']), 'part_number') ?? [];
                    ?>
                        <tr class="even:bg-gray-100 odd:bg-white hover:bg-gray-200 transition duration-300">
                            <td class="p-3 text-center"><?= $index + 1 ?></td>
                            <td class="p-3 text-center"><?= ($good['name']) ?></td>
                            <td class="p-3 text-center"><?php
                                                        foreach ($similarCodes as $code) {
                                                            echo $code;
                                                            echo "<br>";
                                                        }
                                                        ?></td>
                            <td class="p-3 text-center"
                                ondblclick="enableEdit(this)"
                                onblur="updateGoodField(<?= $good['id'] ?>, 'brand', this.innerText)">
                                <?= ($good['brand']) ?>
                            </td>
                            <td class="p-3 text-center"
                                ondblclick="enableEdit(this)"
                                onblur="updateGoodField(<?= $good['id'] ?>, 'price', this.innerText)">
                                <?= ($good['price']) ?>
                            </td>
                            <td class="p-3 text-center"
                                ondblclick="enableEdit(this)"
                                onblur="updateGoodField(<?= $good['id'] ?>, 'description', this.innerText)">
                                <?= ($good['description']) ?>
                            </td>

                            <td class="p-3 text-center">
                                <input
                                    onclick="updateGoodStatus('is_bot_allowed',<?= $good['id'] ?>, this.checked)"
                                    type="checkbox" name="is_bot_allowed"
                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                    <?= $good['is_bot_allowed'] ? 'checked' : '' ?>>
                            </td>
                            <td class="p-3 text-center">
                                <input
                                    onclick="updateGoodStatus('without_price',<?= $good['id'] ?>, this.checked)"
                                    type="checkbox" name="without_price"
                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                    <?= $good['without_price'] ? 'checked' : '' ?>>
                            </td>
                            <!-- <td class="p-3 text-center">
                                <input
                                    onclick="updateGoodStatus('with_price',<?= $good['id'] ?>, this.checked)"
                                    type="checkbox" name="with_price"
                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                    <?= $good['with_price'] ? 'checked' : '' ?>>
                            </td> -->
                            <td class="p-3 text-center">
                                <img src="../../public/icons/delete.svg" alt="delete icon"
                                    class="w-5 h-5 cursor-pointer hover:scale-110 transition duration-300 mx-auto"
                                    onclick="deleteGood(<?= $good['id'] ?>)">
                            </td>
                        </tr>
                <?php
                    endforeach;
                endif; ?>
            </tbody>
        </table>
    </div>
</section>
<script>
    updateGoodStatus = (type, id, value) => {
        const params = new URLSearchParams({
            action: 'updateGoodStatus',
            status: type,
            id: id,
            is_checked: value
        });

        axios.post('../../app/api/goods/GoodsApi.php', params)
            .then(response => {
                if (response.data.status === 'success') {
                    console.log('Status updated successfully!');
                } else {
                    console.error('Error updating status:', response.data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function searchGoods(query) {
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

    function deleteGood(id) {
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: "این عمل غیرقابل بازگشت است!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله، حذف کن!',
            cancelButtonText: 'خیر، انصراف!'
        }).then((result) => {
            if (result.isConfirmed) {
                const params = new URLSearchParams({
                    action: 'deleteGood',
                    id: id
                });

                axios.post('../../app/api/goods/GoodsApi.php', params)
                    .then(response => {
                        if (response.data.status === 'success') {
                            Swal.fire(
                                'حذف شد!',
                                'کد فنی با موفقیت حذف شد.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'خطا!',
                                response.data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        })
    }

    function deleteAllGoods() {
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: "این عمل غیرقابل بازگشت است!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله، حذف کن!',
            cancelButtonText: 'خیر، انصراف!'
        }).then((result) => {
            if (result.isConfirmed) {
                const params = new URLSearchParams({
                    action: 'deleteAllGoods'
                });

                axios.post('../../app/api/goods/GoodsApi.php', params)
                    .then(response => {
                        console.log(response.data);
                        if (response.data.status === 'success') {
                            Swal.fire(
                                'حذف شد!',
                                'همه کدهای فنی با موفقیت حذف شدند.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'خطا!',
                                response.data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        })
    }

    function updateGoodField(id, field, value) {
        const formData = new URLSearchParams();
        formData.append('action', 'updateGoodField');
        formData.append('id', id);
        formData.append('field', field);
        formData.append('value', value);

        axios.post('../../app/api/goods/GoodsApi.php', formData)
            .then(response => {
                if (response.data.status === 'success') {
                    Swal.fire(
                        'به روز رسانی شد!',
                        'فیلد با موفقیت به روز رسانی شد.',
                        'success'
                    );
                } else {
                    Swal.fire(
                        'خطا!',
                        response.data.message,
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function enableEdit(cell) {
        cell.setAttribute('contenteditable', 'true');
        cell.focus();
    }
</script>
<?php
require_once '../components/footer.php';
?>