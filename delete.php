<?php
include 'config.php';

if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    // Lấy thông tin sinh viên
    $result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "<script>alert('Không tìm thấy sinh viên!'); window.location='index.php';</script>";
        exit;
    }

    // Nếu người dùng đã xác nhận xóa
    if (isset($_POST['confirm_delete'])) {
        $conn->query("DELETE FROM SinhVien WHERE MaSV='$MaSV'");
        echo "<script>alert('Đã xóa sinh viên thành công!'); window.location='index.php';</script>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xóa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-danger">Xác nhận xóa sinh viên</h2>
    <div class="card p-3 shadow-sm">
        <img src="Content/images/<?= $row['Hinh'] ?>" alt="Ảnh sinh viên" width="150" class="rounded mx-auto d-block">
        <h4 class="text-center mt-3"><?= $row['HoTen'] ?></h4>
        <p><strong>Giới tính:</strong> <?= $row['GioiTinh'] ?></p>
        <p><strong>Ngày sinh:</strong> <?= $row['NgaySinh'] ?></p>
        
        <div class="d-flex justify-content-center gap-2">
            <form method="POST">
                <button type="submit" name="confirm_delete" class="btn btn-danger">Xác nhận xóa</button>
            </form>
            <a href="index.php" class="btn btn-secondary">Hủy bỏ</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
