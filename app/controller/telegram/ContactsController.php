<?php
if (!isset($DB_NAME)) {
    // If the constant is not defined, it means this file is being accessed directly.
    header("Location: ../../../views/auth/403.php");
}


$contacts = getContacts(USER['user_id']);

function getContacts($userId)
{
    $stmt = DB->prepare("SELECT * FROM contacts WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
