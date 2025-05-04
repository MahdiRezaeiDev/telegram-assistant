<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$totalGoods = getTotalGoodsCount();
$totalContacts = getTotalContactsCount();

function getTotalGoodsCount()
{
    $sql = "SELECT COUNT(*) as total FROM goods";
    $result = DB->prepare($sql);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function getTotalContactsCount()
{
    $sql = "SELECT COUNT(*) as total FROM contacts WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $user_id = USER_ID; // Assuming USER_ID is defined and accessible   
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}
