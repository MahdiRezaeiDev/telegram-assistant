<?php
if (!isset($DB_NAME)) {
    header("Location: ../../../views/auth/403.php");
}

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES['excel_file']['tmp_name'];
        $fileName = $_FILES['excel_file']['name'];
        $fileSize = $_FILES['excel_file']['size'];
        $fileType = $_FILES['excel_file']['type'];

        $file_error = '';

        // Check file type
        $allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
        if (!in_array($fileType, $allowedTypes)) {
            $file_error = "فایل انتخاب شده معتبر نیست. لطفا یک فایل Excel (.xlsx یا .xls) انتخاب کنید.";
            return;
        }

        // Load the spreadsheet
        try {
            $spreadsheet = IOFactory::load($fileTmpPath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            array_shift($sheetData); // Remove header row

            foreach ($sheetData as $row) {
                // Assuming the columns are in the order: Name, Price, Quantity
                $partNumber = sanitizeInput($row['B']);
                $similar_codes = $row['C'];
                $brand_name = $row['D'];
                $price = $row['E'];
                $description = $row['F'];
                $with_price = $row['G'];
                $without_price = $row['H'];
                $is_bot_allowed = $row['I'];


                // Validate data (you can add more validation as needed)
                if (empty($partNumber) || empty($brand_name) || empty($price)) {
                    $file_error = "اطلاعات ناقص است. لطفا تمام ستون‌ها را پر کنید.";
                    return;
                }

                $pattern_id = createPattern($partNumber, $price, $is_bot_allowed, $with_price, $without_price, $description);
                $similar_codes = [$partNumber, ...extractSimilarCodes($similar_codes)];
                $similar_codes = array_unique($similar_codes); // Remove duplicates
                $brand_id = storeBrand($brand_name);

                foreach ($similar_codes as $code) {
                    if (!empty($code)) {
                        storeGoods($code, $brand_id, $pattern_id);
                    }
                }
            }
        } catch (Exception $e) {
            echo "خطا در بارگذاری فایل: " . $e->getMessage();
        }
    } else {
        echo "خطا در بارگذاری فایل.";
    }
}

function createPattern($name, $price, $is_bot_allowed, $with_price, $without_price, $description)
{
    $sql = "INSERT INTO patterns (user_id, name, price, is_bot_allowed, with_price, without_price, description)
            VALUES (:user_id, :name, :price, :is_bot_allowed, :with_price, :without_price, :description)";

    $stmt = DB->prepare($sql);
    $user_id = USER['id'];

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price); // You can use PARAM_INT or PARAM_STR based on your DB column
    $stmt->bindParam(':is_bot_allowed', $is_bot_allowed, PDO::PARAM_INT);
    $stmt->bindParam(':with_price', $with_price, PDO::PARAM_INT);
    $stmt->bindParam(':without_price', $without_price, PDO::PARAM_INT);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return DB->lastInsertId();
    } else {
        return false;
    }
}


function sanitizeInput($data)
{
    // Trim, strip slashes, escape HTML
    $data = htmlspecialchars(stripslashes(trim($data)));

    // Remove all non-alphanumeric characters (letters and numbers only)
    $data = preg_replace("/[^a-zA-Z0-9]/", "", $data);

    // Convert to uppercase
    return strtoupper($data);
}

function extractSimilarCodes($similar_codes)
{
    $codes = explode('/', $similar_codes);

    $result = [];

    foreach ($codes as $code) {
        array_push($result, sanitizeInput($code));
    }
    return $result;
}

function storeBrand($brand_name)
{
    // Check if brand already exists
    $checkSql = "SELECT id FROM brands WHERE brand_name = :brand_name";
    $checkStmt = DB->prepare($checkSql);
    $checkStmt->bindParam(':brand_name', $brand_name, PDO::PARAM_STR);
    $checkStmt->execute();

    $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row['id']; // Return existing brand ID
    }

    // Insert new brand
    $insertSql = "INSERT INTO brands (brand_name) VALUES (:brand_name)";
    $insertStmt = DB->prepare($insertSql);
    $insertStmt->bindParam(':brand_name', $brand_name, PDO::PARAM_STR);

    if ($insertStmt->execute()) {
        return DB->lastInsertId(); // Return new brand ID
    }

    return false; // Insert failed
}


function storeGoods($partNumber, $brand_id, $pattern_id)
{
    $sql = "INSERT INTO goods (part_number, brand_id, pattern_id) VALUES (:part_number, :brand_id, :pattern_id)";
    $stmt = DB->prepare($sql);

    $stmt->bindParam(':part_number', $partNumber, PDO::PARAM_STR);
    $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);
    $stmt->bindParam(':pattern_id', $pattern_id, PDO::PARAM_INT);

    return $stmt->execute();
}
