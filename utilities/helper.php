<?php

function isConnectedToTelegram()
{
    $sql = "SELECT is_connected FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
