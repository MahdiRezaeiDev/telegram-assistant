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

function isAccountExists($userId)
{
    $sql = "SELECT COUNT(*) FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function isAccountConnected($userId)
{
    $sql = "SELECT is_connected FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['is_connected'] == 1;
}

function markAccountAsConnected($userId)
{
    $sql = "UPDATE telegram_credentials SET is_connected = 1 WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}

function markAccountAsDisconnected($userId)
{
    $sql = "UPDATE telegram_credentials SET is_connected = 0 WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}
