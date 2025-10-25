<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

$sellers = getSellers();

function getSellers()
{
    $statement = DB->prepare("SELECT * FROM sellers WHERE user_id = :user ORDER BY id");
    $statement->bindParam(':user', $_SESSION['id'], PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
