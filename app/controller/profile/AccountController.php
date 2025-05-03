<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}


$name = trim($_POST['name'] ?? '');
$lastName = trim($_POST['last_name'] ?? '');
$company = trim($_POST['company'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$role = trim($_POST['role'] ?? 'user');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

// === Validation ===
if (!$name || !$username || !$email || !$password || !$confirmPassword) {
    die("<script>alert('لطفاً تمام فیلدها را پر کنید'); window.history.back();</script>");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<script>alert('ایمیل نامعتبر است'); window.history.back();</script>");
}

if ($password !== $confirmPassword) {
    die("<script>alert('رمز عبور با تکرار آن مطابقت ندارد'); window.history.back();</script>");
}

if (strlen($password) < 6) {
    die("<script>alert('رمز عبور باید حداقل ۶ کاراکتر باشد'); window.history.back();</script>");
}

// === Check for existing user ===
$check = DB->prepare("SELECT users.id, accounts.user_id 
                        FROM users 
                        LEFT JOIN accounts ON users.id = accounts.user_id 
                        WHERE users.username = ? OR users.phone = ? OR accounts.username = ?");
$check->execute([$email, $username]);
if ($check->fetch()) {
    die("<script>alert('شماره تماس یا نام کاربری قبلاً ثبت شده است'); window.history.back();</script>");
}
$check->closeCursor();

// === Insert user ===
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = DB->prepare("INSERT INTO users (name, username, email, password, created_at) VALUES (?, ?, ?, ?, NOW())");
$success = $stmt->execute([$name, $username, $email, $hashedPassword]);
$stmt->closeCursor();

if ($success) {
    echo "<script>alert('حساب کاربری با موفقیت ایجاد شد'); window.location.href = '/users/list.php';</script>";
} else {
    echo "<script>alert('خطا در ایجاد حساب'); window.history.back();</script>";
}
