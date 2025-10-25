<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$prices = getAskedPrices();

function getAskedPrices()
{
    $sql = "SELECT estelam.*, sellers.full_name AS seller_name, users.name
            FROM estelam
            JOIN sellers ON estelam.seller = sellers.id
            JOIN users ON estelam.user = users.id
            ORDER BY estelam.id DESC";

    $stmt = DB->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
