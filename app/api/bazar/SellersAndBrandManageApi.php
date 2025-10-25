<?php
header('Content-Type: application/json');
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../../views/auth/403.php");
    exit;
}
require_once '../../../config/constants.php';
require_once '../../../database/DB_connect.php';;

if (isset($_POST['mode'])) {
    $mode = $_POST['mode'];
    if ($mode === 'create') {
        $sellers = createNewSeller($_POST);
        echo json_encode($sellers);
    }
}

function createNewSeller($data)
{
    $name = $data['name'];
    $phone = $data['phone'];
    $user_id = $_SESSION['id'];

    $sql = "INSERT INTO sellers (user_id,full_name, phone)
            VALUES (:user_id, :name, :phone)";

    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}


if (isset($_POST['updateView'])) {
    $id = $_POST['id'];
    $table = $_POST['table'];

    $sql = "UPDATE $table SET views = CASE WHEN views = 1 THEN 0 ELSE 1 END WHERE id = :id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo true;
    } else {
        echo false;
    }
}

if (isset($_POST['updateSeller'])) {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    $table = $_POST['table'];

    if ($field == 'phone') {
        $value = str_replace(' ', PHP_EOL, $value);
    }

    $sql = "UPDATE $table SET $field = :value WHERE id = :id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo true;
    } else {
        echo false;
    }
}
