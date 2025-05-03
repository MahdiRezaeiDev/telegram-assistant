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
        if (createProfile(USER['id'], $name, $lastName, $username, $company, $phone)) {
            header("Location: ./edit.php?success=1");
            exit;
        } else {
            echo "Error updating profile. Please try again later.";
        }
    }
}

function createProfile($id, $name, $lastName, $username, $company, $phone)
{
    try {
        $sql = "UPDATE users SET name = :name, last_name = :last_name, username = :username, company = :company, phone = :phone, address = :address WHERE id = :id";
        $stmt = DB->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
