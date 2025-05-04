<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../../views/auth/403.php");
    exit;
}

require_once '../../../config/constants.php';
require_once '../../../database/DB_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'updateGoodStatus') {
        $status = $_POST['status'] ?? null;
        $patternId = $_POST['pattern_id'] ?? null;
        $is_checked = $_POST['is_checked'] == 'true' ? 1 : 0;

        updatePatternStatus($status, $patternId, $is_checked);
    }
}

function updatePatternStatus($status, $patternId, $is_checked)
{
    // Allow only specific columns to be updated
    $allowedColumns = ['is_bot_allowed', 'with_price', 'without_price'];

    if (!in_array($status, $allowedColumns)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid status field']);
        return;
    }

    try {
        $sql = "UPDATE patterns SET {$status} = :is_checked WHERE id = :pattern_id";

        $stmt = DB->prepare($sql);
        $stmt->bindParam(':is_checked', $is_checked, PDO::PARAM_BOOL);
        $stmt->bindParam(':pattern_id', $patternId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
