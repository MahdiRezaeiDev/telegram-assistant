<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../../views/auth/403.php");
    exit;
}

require_once '../../../config/constants.php';
require_once '../../../database/DB_connect.php';

if (isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    $userId = $_POST['userId'] ?? null;

    if ($userId) {
        if (
            deleteAccount($userId) && deleteProfile($userId)
        ) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

function deleteAccount($userId)
{
    $stmt = DB->prepare("DELETE FROM accounts WHERE user_id = ?");
    return $stmt->execute([$userId]);
}

function deleteProfile($userId)
{
    $stmt = DB->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$userId]);
}
