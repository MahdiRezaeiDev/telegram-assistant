<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$totalGoods = getTotalGoodsCount();
$totalContacts = getTotalContactsCount();

$lastHourMostRequested = getLastHourMostRequested();
$todayMostRequested = getTodayMostRequested();
$allTimeMostRequested = getAllTimeMostRequested();

function getTotalGoodsCount()
{
    $sql = "SELECT COUNT(*) as total FROM goods
    INNER JOIN patterns ON goods.pattern_id = patterns.id 
    WHERE patterns.user_id = :user_id";
    $result = DB->prepare($sql);
    $user_id = USER_ID; // Assuming USER_ID is defined and accessible
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
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

function getLastHourMostRequested()
{
    $sql = "SELECT prices.*, contacts.name, goods.part_number,goods.brand
            FROM prices
            INNER JOIN contacts ON prices.contact_id = contacts.id
            INNER JOIN goods ON prices.good_id = goods.id
            WHERE prices.created_at >= NOW() - INTERVAL 1 HOUR
            LIMIT 10";

    $stmt = DB->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTodayMostRequested()
{
    $sql = "SELECT prices.*, contacts.name, goods.part_number,goods.brand
            FROM prices
            INNER JOIN contacts ON prices.contact_id = contacts.id
            INNER JOIN goods ON prices.good_id = goods.id
            WHERE DATE(prices.created_at) = CURDATE()
            LIMIT 10";

    $stmt = DB->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllTimeMostRequested()
{
    $sql = "SELECT prices.*, contacts.name, goods.part_number,goods.brand
            FROM prices
            INNER JOIN contacts ON prices.contact_id = contacts.id
            INNER JOIN goods ON prices.good_id = goods.id
            LIMIT 10";

    $stmt = DB->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
