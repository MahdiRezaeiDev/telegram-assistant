<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['excel_file']['tmp_name'];
        $fileName = $_FILES['excel_file']['name'];
        $fileSize = $_FILES['excel_file']['size'];
        $fileType = $_FILES['excel_file']['type'];

        // Check file type
        $allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "فایل انتخاب شده معتبر نیست. لطفا یک فایل Excel انتخاب کنید.";
            exit;
        }

        // Load the spreadsheet
        try {
            $spreadsheet = IOFactory::load($fileTmpPath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            
        } catch (Exception $e) {
            echo "خطا در بارگذاری فایل: " . $e->getMessage();
        }
    } else {
        echo "خطا در بارگذاری فایل.";
    }
}
