<?php

function isConnectedToTelegram()
{
    $sql = "SELECT is_connected FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $userId = USER_ID;
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($result['is_connected'])) {
        return $result['is_connected'] == 1;
    }

    return false;
}

function isDirExists($userId)
{
    $sql = "SELECT session_name FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $userId = USER_ID;
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        return false;
    }

    $sessionName = $result['session_name'];
    $sessionDir = __DIR__ . "/../sessions/" . $sessionName;
    return is_dir($sessionDir) && file_exists($sessionDir . "/.madeline-proto.session");
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

    if (isset($result['is_connected'])) {
        return $result['is_connected'] == 1;
    }

    return false;
}

function markAccountAsConnected($userId, $telegramId)
{
    $sql = "UPDATE telegram_credentials SET is_connected = 1, telegram_id = :telegram_id WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':telegram_id', $telegramId, PDO::PARAM_INT);
    return $stmt->execute();
}

function markAccountAsDisconnected($userId)
{
    $sql = "UPDATE telegram_credentials SET is_connected = 0 WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}

function getAccountSession($userId)
{
    $sql = "SELECT session_name FROM telegram_credentials WHERE user_id = :user_id";
    $stmt = DB->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $session = explode('\\', $stmt->fetchColumn());

    return $session[1];
}

function sanitizeDataInput($data)
{
    // Convert null to empty string to avoid deprecation warning
    $data = htmlspecialchars(stripslashes(trim((string) $data)));

    // Remove all non-alphanumeric characters (letters and numbers only)
    $data = preg_replace("/[^a-zA-Z0-9]/", "", $data);

    // Convert to uppercase
    return strtoupper($data);
}
