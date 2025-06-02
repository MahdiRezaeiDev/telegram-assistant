<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

if (isset($_GET['userId']) && is_numeric($_GET['userId'])) {
    $userId = intval($_GET['userId']);
} else {
    exit;
}

$currentUser = getUserData($userId);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    // Define variables and initialize with empty values
    $name = $lastName  = $company = $phone = $address = "";
    $name_err = $lastName_err  = $company_err = $phone_err = $address_err = "";

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

    print_r($name_err . " " . $lastName_err . " " . $company_err . " " . $phone_err . " " . $address_err);

    // Check for errors before updating the profile
    if (empty($name_err) && empty($lastName_err) && empty($username_err) && empty($company_err) && empty($phone_err) && empty($address_err)) {
        // Update profile in the database
        if (updateProfile($userId, $name, $lastName, $company, $phone, $address)) {
            header("Location: ./editProfile.php?userId=$userId" . "&success=1");
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
        $sql = "SELECT users.* , accounts.username
         FROM users 
         INNER JOIN accounts ON users.id = accounts.user_id
         WHERE users.id = :id;";

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    // Define variables and initialize with empty values
    $password = $confirm_password = "";
    $password_err = $confirm_password_err = "";

    $username = $username_err = "";

    if (empty(sanitizeInput($_POST["username"]))) {
        $username_err = "لطفا نام کاربری را وارد کنید.";
    } else {
        $username = sanitizeInput($_POST["username"]);
    }

    // Validate inputs
    if (empty(sanitizeInput($_POST["password"]))) {
        $password_err = "لطفا رمز عبور جدید را وارد کنید.";
    } elseif (strlen(sanitizeInput($_POST["password"])) < 6) {
        $password_err = "رمز عبور باید حداقل 6 کاراکتر باشد.";
    } else {
        $password = sanitizeInput($_POST["password"]);
    }

    if (empty(sanitizeInput($_POST["confirm_password"]))) {
        $confirm_password_err = "لطفا تکرار رمز عبور را وارد کنید.";
    } else {
        $confirm_password = sanitizeInput($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "رمز عبور و تکرار آن مطابقت ندارند.";
        }
    }

    // Check for errors before updating the password
    if (empty($password_err) && empty($confirm_password_err)) {
        // Update password in the database
        if (updatePassword($userId, password_hash($password, PASSWORD_DEFAULT), $username)) {
            header("Location: ./editProfile.php?userId=$userId" . "&success=1");
            exit;
        } else {
            echo "Error updating password. Please try again later.";
        }
    }
}

function updatePassword($userId, $password, $username)
{
    try {
        // Prepare a select statement
        $sql = "UPDATE accounts SET password = :password , username = :username WHERE user_id = :id";

        // Prepare the SQL statement
        $stmt = DB->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

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
