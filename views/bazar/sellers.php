<?php
$pageTitle = "مدیریت برند و فروشندگان اجناس";
$iconUrl = 'purchase.svg';
require_once '../components/init.php';
require_once '../../app/controller/bazar/GoodsManagementController.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";
?>
<div class="max-w-5xl grid grid-cols-1 lg:grid-cols-4 gap-5 mx-auto">
    <section class="p-3 col-span-4">
        <div class="py-2 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">لیست فروشندگان</h2>
                <p class="text-xs">برای ویرایش بروی ستون مورد نظر دبل کلیک نمایید.</p>
            </div>
            <button onclick="toggleForm('sellerModal')" class="bg-sky-600 text-white rounded-sm py-1 px-3">ایجاد</button>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-800 text-white text-sm">
                    <th class="p-3 text-center">#</th>
                    <th class="p-3 text-right">نام فروشنده</th>
                    <th class="p-3 text-right">شماره تماس</th>
                    <th class="p-3 text-right">نمایش</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sellers as $key => $seller) : ?>
                    <tr class="text-sm border-b border-gray-200 even:bg-gray-100">
                        <td class="p-3 text-center"><?= $key + 1 ?></td>
                        <td class="p-3" ondblclick="makeEditable('sellers',this, 'full_name', <?= $seller['id'] ?>)"><?= $seller['full_name'] ?></td>
                        <td class="p-3" ondblclick="makeEditable('sellers',this, 'phone', <?= $seller['id'] ?>)"><?= htmlspecialchars($seller['phone']) ?></td>
                        <td class="p-3">
                            <input type="checkbox" name="view" onclick="updateView('sellers',<?= $seller['id'] ?>)" <?= $seller['view'] ? 'checked' : '' ?>>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </section>
</div>

<div id="sellerModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex justify-center items-center hidden">
    <div class="bg-white w-full max-w-2xl mx-3 rounded-2xl shadow-xl overflow-hidden animate-fadeIn">
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-bold text-gray-800">ایجاد فروشنده جدید</h2>
            <button onclick="toggleForm('sellerModal')"
                class="text-gray-500 hover:text-red-600 text-xl leading-none font-bold">
                ×
            </button>
        </div>

        <!-- Body -->
        <div class="px-6 py-5">
            <form id="sellerForm" action="#" method="post" class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <input type="hidden" name="mode" value="create">

                <!-- Name -->
                <div class="flex flex-col">
                    <label for="name" class="text-sm font-medium text-gray-700 mb-1">نام فروشنده</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="مثلاً: علی رضایی"
                        class="border border-gray-300 focus:border-sky-500 focus:ring-1 focus:ring-sky-400 rounded-md px-3 py-2 outline-none transition-all text-right">
                </div>

                <!-- Phone -->
                <div class="flex flex-col">
                    <label for="phone" class="text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        placeholder="مثلاً: ۰۷۸۱۲۳۴۵۶۷"
                        class="border border-gray-300 focus:border-sky-500 focus:ring-1 focus:ring-sky-400 rounded-md px-3 py-2 outline-none transition-all text-right">
                </div>

                <!-- Buttons -->
                <div class="lg:col-span-2 flex justify-end items-center gap-4 mt-3">
                    <p id="operationMessage" class="text-green-600 text-sm hidden"></p>
                    <button
                        type="button"
                        onclick="submitSellerForm()"
                        class="bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-md px-5 py-2 transition-all">
                        ذخیره
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional: Fade-in animation -->
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-in-out;
    }
</style>


<div id="updateViewMessage" class="fixed left-1/2 -translate-x-1/2 top-full transition">
    <p class="bg-green-600 text-white p-2 rounded-sm">عملیات موفقانه انجام شد.</p>
</div>
<script>
    const endpoint = "../../app/api/bazar/SellersAndBrandManageApi.php";

    function submitSellerForm() {
        const form = document.getElementById('sellerForm');
        const formData = new FormData(form);

        axios.post(endpoint, formData)
            .then(response => {

                if (response.data) {
                    const operationMessage = document.getElementById('operationMessage');
                    operationMessage.classList.remove('hidden');
                    document.getElementById('operationMessage').innerText = 'فروشنده جدید با موفقیت ایجاد شد';
                    setTimeout(() => {
                        operationMessage.classList.add('hidden');
                        window.location.reload();
                    }, 3000);
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function toggleForm(form) {
        const modal = document.getElementById(form);
        modal.classList.toggle('hidden');
    }

    function submitBrandForm() {
        const form = document.getElementById('brandForm');
        const formData = new FormData(form);
        formData.action = "createBrand";

        axios.post(endpoint, formData)
            .then(response => {
                if (response.data) {
                    const operationMessage = document.getElementById('operationMessage');
                    operationMessage.classList.remove('hidden');
                    document.getElementById('operationMessage2').innerText = 'برند جدید با موفقیت ایجاد شد';
                    setTimeout(() => {
                        operationMessage.classList.add('hidden');
                        window.location.reload();
                    }, 3000);
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function updateView(table, id) {
        console.log('started');
        const formData = new FormData();
        formData.append('updateView', 'updateView');
        formData.append('id', id);
        formData.append('table', table);

        axios.post(endpoint, formData)
            .then(response => {
                if (response.data) {
                    const updateViewMessage = document.getElementById('updateViewMessage');
                    console.log(updateViewMessage);
                    updateViewMessage.classList.remove('top-full');
                    updateViewMessage.classList.add('bottom-5');
                    setTimeout(() => {
                        updateViewMessage.classList.add('top-full');
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    }

    function editSellerForm() {
        const form = document.getElementById('sellerEditForm');
        const formData = new FormData(form);

        axios.post(endpoint, formData)
            .then(response => {
                if (response.data) {
                    const operationMessage = document.getElementById('operationMessage');
                    operationMessage.classList.remove('hidden');
                    document.getElementById('operationMessage').innerText = 'فروشنده با موفقیت ویرایش شد';
                    setTimeout(() => {
                        operationMessage.classList.add('hidden');
                        window.location.reload();
                    }, 3000);
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function makeEditable(table, cell, fieldName, sellerId) {
        // Check if the cell already contains an input element
        if (cell.querySelector('input')) {
            return; // Exit if the input is already active
        }

        let style = '';

        const lefToRightField = ['kind', 'phone', 'latinName']

        if (lefToRightField.includes(fieldName)) {
            style = 'style="direction: ltr !important;"';
        }

        let originalContent = cell.innerHTML.replace(/[\r\n]+/g, ' ');
        cell.innerHTML = `<input ${style} type="text" class="border-2 border-gray-300 outline-none p-2 w-full" value="${originalContent}" onblur="confirmEdit('${table}',this, '${fieldName}', ${sellerId}, '${originalContent}')">`;
        cell.firstChild.focus();
    }

    function confirmEdit(table, input, fieldName, sellerId, originalContent) {
        let newValue = input.value;
        if (newValue !== originalContent) {
            if (confirm('آیا مطمئن هستید که تغییرات را ذخیره کنید?')) {
                // Save changes
                updateSeller(table, sellerId, fieldName, newValue, input);
            } else {
                // Revert changes
                input.parentElement.innerHTML = originalContent;
            }
        } else {
            // No changes made, revert back
            input.parentElement.innerHTML = originalContent;
        }
    }

    function updateSeller(table, id, field, value, input) {

        const formData = new FormData();
        formData.append('updateSeller', 'updateSeller');
        formData.append('id', id);
        formData.append('field', field);
        formData.append('value', value);
        formData.append('table', table);

        axios.post(endpoint, formData).then(response => {
            if (response.data) {
                input.parentElement.innerHTML = value;
                const updateViewMessage = document.getElementById('updateViewMessage');
                updateViewMessage.classList.remove('top-full');
                updateViewMessage.classList.add('bottom-5');
                setTimeout(() => {
                    updateViewMessage.classList.add('top-full');
                }, 3000);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Error updating seller');
            input.parentElement.innerHTML = originalContent;
        });

    }
</script>
<?php require_once '../components/footer.php'; ?>