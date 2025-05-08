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

if (isset($_POST['action']) && $_POST['action'] === 'deleteGood') {
    $patternId = $_POST['pattern_id'] ?? null;

    if ($patternId) {
        deleteGood($patternId);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Pattern ID is required']);
    }
}

function deleteGood($patternId)
{
    try {
        $sql = "UPDATE goods SET is_deleted = NOT is_deleted WHERE id = :pattern_id"; // fixed syntax
        $stmt = DB->prepare($sql);
        $stmt->bindParam(':pattern_id', $patternId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteAllGoods') {
    deleteAllGoods();
}

function deleteAllGoods()
{
    try {
        $sql = "DELETE FROM patterns"; // fixed syntax
        $stmt = DB->prepare($sql);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'updateGoodField') {
    $id = $_POST['id'] ?? null;
    $field = $_POST['field'] ?? '';
    $value = $_POST['value'] ?? '';

    $allowedFields = ['brand', 'price', 'description'];

    if (!$id || !in_array($field, $allowedFields)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
        exit;
    }

    try {
        $stmt = DB->prepare("UPDATE patterns SET $field = :value WHERE id = :id");
        $stmt->execute(['value' => $value, 'id' => $id]);
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
