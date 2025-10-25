<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$allSellers = getSellers();

function getSellers()
{
    $sql = "SELECT * FROM sellers WHERE view = 1 ORDER BY id";
    $stmt = DB->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

