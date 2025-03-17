<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "Test1");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy mã sinh viên từ URL
$maSV = $_GET['MaSV'] ?? '';
$query = "SELECT * FROM sinhvien WHERE MaSV = '$maSV'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết sinh viên</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 style="color: blue;">Thông tin chi tiết sinh viên</h2>
        <img src="student_image.png" alt="Student Image" style="width: 100px; height: 100px;">
        <p><strong>Mã Sinh Viên:</strong> <?= $row['MaSV'] ?? 'Không có dữ liệu' ?></p>
        <p><strong>Họ và Tên:</strong> <?= $row['HoTen'] ?? 'Không có dữ liệu' ?></p>
        <p><strong>Giới tính:</strong> <?= $row['GioiTinh'] ?? 'Không có dữ liệu' ?></p>
        <p><strong>Ngày sinh:</strong> <?= $row['NgaySinh'] ?? 'Không có dữ liệu' ?></p>
        <p><strong>Ngành học:</strong> <?= $row['NganhHoc'] ?? 'Không có dữ liệu' ?></p>
        <a href="index.php"><button>Quay lại</button></a>
    </div>
</body>
</html>

<?php
// Đóng kết nối
mysqli_close($conn);
?>