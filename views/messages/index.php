<?php
$pageTitle = "متن پیام پیشفرض";
$category = "messages";
$iconUrl = 'goods.svg';

require_once '../components/init.php';
require_once '../components/header.php';
require_once "../../layouts/navigation.php";
require_once "../../layouts/sidebar.php";

// بارگذاری پیام‌های فعلی کاربر
$stmt = DB->prepare("SELECT * FROM default_message WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([USER['user_id']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="w-full p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white shadow-sm rounded-2xl p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2 mb-6">
            پیام‌های پیش‌فرض تلگرام
        </h2>

        <!-- ✅ فرم ایجاد پیام جدید -->
        <form id="messageForm" class="mb-6 space-y-3">
            <label for="default_message" class="block text-sm font-medium text-gray-700 mb-2"> 
            برای افزودن پیام جدید و یا ویرایش پیام پیش فرض قبلی پیام خود را وارد نمایید.
            </label>
            <textarea id="default_message" name="default_message" rows="3" required
                class="w-full border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm p-3 resize-none"
                placeholder="مثلاً: سلام، سفارش شما ثبت شد ✅"></textarea>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium shadow">
                ذخیره پیام
            </button>
        </form>

        <!-- ✅ لیست پیام‌ها -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">لیست پیام‌ها</h3>

            <div id="messagesList">
                <?php if ($messages): ?>
                    <?php foreach ($messages as $msg): ?>
                        <div class="message-item flex justify-between items-start p-4 mb-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex-1">
                                <p class="text-gray-800 text-sm leading-relaxed whitespace-pre-line message-text">
                                    <?= htmlspecialchars($msg['message']) ?>
                                </p>
                                <p class="text-xs text-gray-400 mt-1"><?= date('Y/m/d', strtotime($msg['created_at'])) ?></p>
                            </div>
                            <div class="flex items-center gap-3">
                                <button class="text-red-600 hover:text-red-700 text-sm delete-btn"
                                    data-id="<?= $msg['id'] ?>">حذف</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-gray-500 py-6 text-sm">هیچ پیامی ثبت نشده است.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('messageForm');
    const list = document.getElementById('messagesList');
    const textarea = document.getElementById('default_message');

    // ✅ Create message
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = textarea.value.trim();
        if (!message) return alert('متن پیام را وارد کنید.');

        const res = await fetch('../../app/api/message/messageAPI.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'create', message })
        });
        const html = await res.text();
        list.innerHTML = html;
        textarea.value = '';
    });

    // ✅ Handle delete & edit actions
    list.addEventListener('click', async (e) => {
        const btn = e.target.closest('button');
        if (!btn) return;

        const id = btn.dataset.id;
        if (btn.classList.contains('delete-btn')) {
            if (!confirm('آیا مطمئن هستید برای حذف؟')) return;
            const res = await fetch('../../app/api/message/messageAPI.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'delete', id })
            });
            list.innerHTML = await res.text();
        }

        if (btn.classList.contains('edit-btn')) {
            const item = btn.closest('.message-item');
            const textEl = item.querySelector('.message-text');
            const oldText = textEl.textContent.trim();

            // Replace text with editable textarea
            textEl.outerHTML = `
                <textarea class="edit-area w-full border border-gray-300 rounded-lg p-2 text-sm mb-1">${oldText}</textarea>
            `;
            btn.textContent = 'ذخیره';
            btn.classList.remove('edit-btn');
            btn.classList.add('save-btn');
        }

        if (btn.classList.contains('save-btn')) {
            const item = btn.closest('.message-item');
            const newText = item.querySelector('.edit-area').value.trim();
            if (!newText) return alert('متن پیام نمی‌تواند خالی باشد.');

            const res = await fetch('../../app/api/message/messageAPI.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'update', id, message: newText })
            });
            list.innerHTML = await res.text();
        }
    });
});
</script>

<?php require_once '../components/footer.php'; ?>
