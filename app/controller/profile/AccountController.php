<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
    exit;
}

$name = $lastName = $username = $company = $phone = $password = $confirm_password = "";
$name_err = $lastName_err = $username_err = $company_err = $phone_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    // Validate and sanitize inputs
    if (empty(sanitizeInput($_POST["name"]))) {
        $name_err = "لطفا نام خود را وارد کنید.";
    } else {
        $name = sanitizeInput($_POST["name"]);
    }

    if (empty(sanitizeInput($_POST["last_name"]))) {
        $lastName_err = "لطفا نام خانوادگی خود را وارد کنید.";
    } else {
        $lastName = sanitizeInput($_POST["last_name"]);
    }

    if (empty(sanitizeInput($_POST["username"]))) {
        $username_err = "لطفا نام کاربری خود را وارد کنید.";
    } elseif (usernameExists($_POST["username"])) {
        $username_err = "این نام کاربری قبلاً ثبت شده است.";
    } else {
        $username = sanitizeInput($_POST["username"]);
    }

    if (empty(sanitizeInput($_POST["company"]))) {
        $company_err = "لطفا نام شرکت را وارد کنید.";
    } else {
        $company = sanitizeInput($_POST["company"]);
    }

    if (empty(sanitizeInput($_POST["phone"]))) {
        $phone_err = "لطفا شماره تماس را وارد کنید.";
    } else {
        $phone = sanitizeInput($_POST["phone"]);
    }

    // Password validation
    $password = sanitizeInput($_POST["password"] ?? '');
    $confirm_password = sanitizeInput($_POST["confirm_password"] ?? '');

    if (empty($password)) {
        $password_err = "لطفاً گذرواژه را وارد کنید.";
    } elseif (strlen($password) < 6) {
        $password_err = "گذرواژه باید حداقل ۶ کاراکتر باشد.";
    }

    if (empty($confirm_password)) {
        $confirm_password_err = "لطفاً تکرار گذرواژه را وارد کنید.";
    } elseif ($password !== $confirm_password) {
        $confirm_password_err = "گذرواژه و تکرار آن یکسان نیستند.";
    }

    // If no validation errors
    if (
        empty($name_err) && empty($lastName_err) && empty($username_err) &&
        empty($company_err) && empty($phone_err) &&
        empty($password_err) && empty($confirm_password_err)
    ) {
        $user_id = createProfile($name, $lastName, $company, $phone);
        if ($user_id) {
            $role = $_POST['role'] ?? 'user';
            $account_id = createAccount($user_id, $username, $password, $role);
            if ($account_id) {
                header("Location: ./list.php?success=1");
                exit;
            } else {
                $username_err = "خطا در ایجاد حساب کاربری.";
            }
        } else {
            $username_err = "خطا در ثبت اطلاعات کاربر.";
        }
    }
}

function createProfile($name, $lastName, $company, $phone)
{
    $sql = "INSERT INTO users (name, last_name, company, phone) 
            VALUES (:name, :last_name, :company, :phone)";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':company', $company);
    $stmt->bindParam(':phone', $phone);

    return $stmt->execute() ? DB->lastInsertId() : false;
}

function createAccount($user_id, $username, $password, $role)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO accounts (user_id, username, password, role) 
            VALUES (:user_id, :username, :password, :role)";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    return $stmt->execute() ? DB->lastInsertId() : false;
}

function usernameExists($username)
{
    $sql = "SELECT 1 FROM accounts WHERE username = :username LIMIT 1";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    return $stmt->fetchColumn() !== false;
}

function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
