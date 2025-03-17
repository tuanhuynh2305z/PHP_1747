<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['Hinh'])) {
    $uploadDir = 'Content/images/';
    $fileName = basename($_FILES['Hinh']['name']);
    $targetFilePath = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFilePath)) {
            echo "Upload thành công!";
        } else {
            echo "Lỗi khi tải lên!";
        }
    } else {
        echo "Chỉ hỗ trợ file JPG, JPEG, PNG, GIF.";
    }
} else {
    echo "Không có file được tải lên!";
}
?>