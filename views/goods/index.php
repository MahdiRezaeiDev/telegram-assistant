<?php
$pageTitle = "مدیریت کالاها";
$category = "goods";
$iconUrl = 'goods.svg';
require_once '../components/init.php';
require_once '../../app/controller/goods/FileController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";

$goods = getAllGoods(); // Assuming this function fetches the goods list from the database
?>
<section class="shadow-md rounded-lg p-6 w-full">
    <div class="mb-4 flex justify-between items-center">
        <div class="">
            <h1 class="text-2xl font-bold text-gray-800">لیست کدهای فنی اضافه شده</h1>
            <span class="text-sm text-gray-600 pb-4">در اینجا لیست کدهای فنی اضافه شده توسط شما نمایش داده می‌شود.</span>
        </div>
        <input type="search" name="search" id="search" placeholder="جستجو..."
            onkeyup="searchGoods(this.value)"
            class="rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <a class="rounded bg-sky-600 text-white text-xs p-3" href="../goods/upload.php">آپلود فایل کد های فنی</a>
    </div>
    <table class="table-fixed w-full">
        <thead class="sticky_nav sticky bg-gray-800 border border-gray-600">
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
                <th scope="col" class="text-white text-xs font-semibold p-3 text-center">
                    ارسال با قیمت
                </th>
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
                foreach ($goods as $index => $good): ?>
                    <tr class="even:bg-gray-100 odd:bg-white hover:bg-gray-200 transition duration-300">
                        <td class="p-3 text-center"><?= $index + 1 ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($good['part_number']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($good['name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($good['brand_name']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($good['price']) ?></td>
                        <td class="p-3 text-center"><?= htmlspecialchars($good['description']) ?></td>
                        <td class="p-3 text-center">
                            <input
                                onclick="updateGoodStatus('is_bot_allowed',<?= $good['pattern_id'] ?>, this.checked)"
                                type="checkbox" name="blocked" id="blocked"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                <?= $good['is_bot_allowed'] ? 'checked' : '' ?>>
                        </td>
                        <td class="p-3 text-center">
                            <input
                                onclick="updateGoodStatus('with_price',<?= $good['pattern_id'] ?>, this.checked)"
                                type="checkbox" name="blocked" id="blocked"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                <?= $good['with_price'] ? 'checked' : '' ?>>
                        </td>
                        <td class="p-3 text-center">
                            <input
                                onclick="updateGoodStatus('without_price',<?= $good['pattern_id'] ?>, this.checked)"
                                type="checkbox" name="blocked" id="blocked"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2"
                                <?= $good['without_price'] ? 'checked' : '' ?>>
                        </td>
                        <td class="p-3 text-center">
                            <img src="../../public/icons/delete.svg" alt="delete icon"
                                class="w-5 h-5 cursor-pointer hover:scale-110 transition duration-300"
                                onclick="deleteGood(<?= $good['pattern_id'] ?>)">
                        </td>
                    </tr>
            <?php
                endforeach;
            endif; ?>
        </tbody>
    </table>
</section>
<script>
    updateGoodStatus = (type, id, value) => {
        const params = new URLSearchParams({
            action: 'updateGoodStatus',
            status: type,
            pattern_id: id,
            is_checked: value
        });

        axios.post('../../app/api/goods/GoodsApi.php', params)
            .then(response => {
                console.log(response.data);
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
            confirmButtonText: 'بله، حذف کن!'
        }).then((result) => {
            if (result.isConfirmed) {
                const params = new URLSearchParams({
                    action: 'deleteGood',
                    pattern_id: id
                });

                axios.post('../../app/api/goods/GoodsApi.php', params)
                    .then(response => {
                        console.log(response.data);
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
</script>
<?php
require_once '../components/footer.php';
?>