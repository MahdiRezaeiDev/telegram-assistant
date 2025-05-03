<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$users = getAllUsers();

function getAllUsers()
{
    $sql = "SELECT * FROM users ";
    $stmt = DB->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
