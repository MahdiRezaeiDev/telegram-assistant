<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    // Define variables and initialize with empty values
    $name = $lastName = $username = $company = $phone  = "";
    $name_err = $lastName_err = $username_err = $company_err = $phone_err  = "";

    // Validate inputs
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
    } else {
        $username = sanitizeInput($_POST["username"]);
    }

    if (empty(sanitizeInput($_POST["company"]))) {
        $company_err = "لطفا نام شرکت خود را وارد کنید.";
    } else {
        $company = sanitizeInput($_POST["company"]);
    }

    if (empty(sanitizeInput($_POST["phone"]))) {
        $phone_err = "لطفا شماره تماس خود را وارد کنید.";
    } else {
        $phone = sanitizeInput($_POST["phone"]);
    }

    // Check for errors before updating the profile
    if (empty($name_err) && empty($lastName_err) && empty($username_err) && empty($company_err) && empty($phone_err) && empty($address_err)) {
        // Update profile in the database
        $user_id = createProfile($name, $lastName, $company, $phone);
        if ($user_id) {
            // Create account in the database
            $role = $_POST['role'] ?? 'user'; // Default to 'user' if not set
            $password = $_POST['password'] ?? 'default_password'; // Default password if not set
            $account_id = createAccount($user_id, $username, $password, $role);

            header("Location: ./list.php?success=1");
            exit;
        } else {
            echo "Error updating profile. Please try again later.";
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

    if ($stmt->execute()) {
        return DB->lastInsertId(); // Return last inserted ID (useful if ID is auto-increment)
    } else {
        // Log or handle error
        $error = $stmt->errorInfo();
        throw new Exception("Database error: " . $error[2]);
    }
}

function createAccount($user_id, $username, $password, $role)
{
    $sql = "INSERT INTO accounts (user_id, username, password, role) 
            VALUES (:user_id, :username, :password, :role)";
    $stmt = DB->prepare($sql);

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Hash the password
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        return DB->lastInsertId(); // Return last inserted ID (useful if ID is auto-increment)
    } else {
        // Log or handle error
        $error = $stmt->errorInfo();
        throw new Exception("Database error: " . $error[2]);
    }
}

function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
