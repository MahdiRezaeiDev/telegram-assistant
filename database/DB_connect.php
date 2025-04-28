<?php
// Establish PDO database connection
try {
    $pdo = new PDO("mysql:host=$HOST;dbname=$DB_NAME;charset=utf8mb4", $USERNAME, $PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    define('DB', $pdo);
} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();
    exit();
}
