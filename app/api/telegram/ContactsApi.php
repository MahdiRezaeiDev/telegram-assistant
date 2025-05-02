<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../../views/auth/403.php");
    exit;
}

require_once '../../../config/constants.php';
require_once '../../../database/DB_connect.php';

if (isset($_POST['action']) && $_POST['action'] === 'updateContactStatus') {
    $contactId = $_POST['contactId'] ?? null;
    $isBlocked = $_POST['isBlocked'] ?? null;

    if ($contactId && $isBlocked !== null) {
        $stmt = DB->prepare("UPDATE contacts SET is_blocked = ? WHERE id = ?");
        $stmt->execute([$isBlocked, $contactId]);
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
