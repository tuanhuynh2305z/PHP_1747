<?php
include 'config.php';

// Lấy danh sách mã ngành từ bảng NganhHoc
$query_nganh = "SELECT MaNganh, TenNganh FROM NganhHoc";
$result_nganh = $conn->query($query_nganh);

// Kiểm tra nếu có lỗi truy vấn
if (!$result_nganh) {
    die("Lỗi SQL: " . $conn->error);
}

// Xử lý khi nhấn nút "Thêm sinh viên"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = $_POST['masv'];
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $manganh = $_POST['manganh'];
    $hinhanh = $_FILES['hinhanh']['name'];

    // Kiểm tra thư mục lưu ảnh
    $upload_dir = "Content/images/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Xử lý upload ảnh
    if (move_uploaded_file($_FILES['hinhanh']['tmp_name'], $upload_dir . $hinhanh)) {
        // Thêm sinh viên vào bảng SinhVien
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, MaNganh, Hinh) 
                VALUES ('$masv', '$hoten', '$gioitinh', '$ngaysinh', '$manganh', '$hinhanh')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Thêm sinh viên thành công!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm sinh viên!');</script>";
        }
    } else {
        echo "<script>alert('Lỗi tải ảnh lên!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = "block";
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="test1.php">Test1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Sinh viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hocphan.php">Học phần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php"> Đăng ký</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Nội dung chính -->
<div class="container mt-4">
    <h2 class="text-primary">Thêm sinh viên</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Quay lại</a>

    <div class="card p-4">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Mã Sinh Viên:</label>
                <input type="text" name="masv" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Họ và Tên:</label>
                <input type="text" name="hoten" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Giới tính:</label>
                <select name="gioitinh" class="form-select">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày sinh:</label>
                <input type="date" name="ngaysinh" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Ngành:</label>
                <select name="manganh" class="form-select" required>
                    <option value="">-- Chọn mã ngành --</option>
                    <?php while ($row = $result_nganh->fetch_assoc()): ?>
                        <option value="<?= $row['MaNganh'] ?>"><?= $row['TenNganh'] ?> (<?= $row['MaNganh'] ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình ảnh:</label>
                <input type="file" name="hinhanh" class="form-control" onchange="previewImage(event)" required>
                <img id="preview" src="#" alt="Xem trước ảnh" style="display:none; width:100px; margin-top:10px;">
            </div>

            <button type="submit" class="btn btn-success">Thêm sinh viên</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
