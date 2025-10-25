<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../../views/auth/403.php");
    exit;
}

require_once '../../../config/constants.php';
require_once '../../../database/DB_connect.php';

$user_id = $_SESSION["id"];
$action = $_POST['action'] ?? null;
$message = trim($_POST['message'] ?? '');
$id = $_POST['id'] ?? null;

// ✅ Create or Update (only one message per user)
if ($action === 'create' && $message) {
    // Check if the user already has a message
    $check = DB->prepare("SELECT id FROM default_message WHERE user_id = ?");
    $check->execute([$user_id]);
    $existing = $check->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Update existing message
        $stmt = DB->prepare("UPDATE default_message SET message = ?, created_at = NOW() WHERE user_id = ?");
        $stmt->execute([$message, $user_id]);
    } else {
        // Insert new message
        $stmt = DB->prepare("INSERT INTO default_message (user_id, message, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$user_id, $message]);
    }
}

// ✅ Update specific message (used for inline editing)
if ($action === 'update' && $id && $message) {
    $stmt = DB->prepare("UPDATE default_message SET message = ?, created_at = NOW() WHERE id = ? AND user_id = ?");
    $stmt->execute([$message, $id, $user_id]);
}

// ✅ Delete message
if ($action === 'delete' && $id) {
    $stmt = DB->prepare("DELETE FROM default_message WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);
}

// ✅ Fetch updated list
$stmt = DB->prepare("SELECT * FROM default_message WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
                <button class="text-red-600 hover:text-red-700 text-sm delete-btn" data-id="<?= $msg['id'] ?>">حذف</button>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="text-center text-gray-500 py-6 text-sm">هیچ پیامی ثبت نشده است.</div>
<?php endif; ?>
