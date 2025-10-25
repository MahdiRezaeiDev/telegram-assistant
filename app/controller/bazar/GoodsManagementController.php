<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$sellers = getSellers();

function getSellers()
{
    $statement = DB->prepare("SELECT id, full_name, phone, view FROM sellers");

    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
