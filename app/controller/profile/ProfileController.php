<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$currentUser = getUserData(USER['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define variables and initialize with empty values
    $name = $lastName = $username = $company = $phone = $address = "";
    $name_err = $lastName_err = $username_err = $company_err = $phone_err = $address_err = "";

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

    if (empty(sanitizeInput($_POST["address"]))) {
        $address_err = "لطفا آدرس خود را وارد کنید.";
    } else {
        $address = sanitizeInput($_POST["address"]);
    }

    // Check for errors before updating the profile
    if (empty($name_err) && empty($lastName_err) && empty($username_err) && empty($company_err) && empty($phone_err) && empty($address_err)) {
        // Update profile in the database
        if (updateProfile(USER['id'], $name, $lastName, $username, $company, $phone, $address)) {
            header("Location: ./edit.php?success=1");
            exit;
        } else {
            echo "Error updating profile. Please try again later.";
        }
    }
}

function updateProfile($userId, $name, $lastName, $company, $phone, $address)
{
    try {
        // Prepare a select statement
        $sql = "UPDATE users SET name = :name, last_name = :last_name, company = :company, phone = :phone, address = :address WHERE id = :id";

        // Prepare the SQL statement
        $stmt = DB->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function getUserData($userId)
{
    try {
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE id = :id";

        // Prepare the SQL statement
        $stmt = DB->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
