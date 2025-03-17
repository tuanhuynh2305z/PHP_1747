<?php
include 'config.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

// Lấy danh sách ngành học
$query_nganh = "SELECT * FROM NganhHoc";
$result_nganh = $conn->query($query_nganh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $MaNganh = $_POST['manganh'];

    if ($_FILES['hinhanh']['name']) {
        $hinhanh = $_FILES['hinhanh']['name'];
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], "Content/images/" . $hinhanh);
    } else {
        $hinhanh = $row['Hinh'];
    }

    $sql = "UPDATE SinhVien SET HoTen='$hoten', GioiTinh='$gioitinh', NgaySinh='$ngaysinh', Hinh='$hinhanh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
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
<div class="container mt-4">
    <h2 class="text-primary">Chỉnh sửa thông tin sinh viên</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Quay lại</a>

    <div class="card p-4">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Họ và Tên:</label>
                <input type="text" name="hoten" class="form-control" value="<?= $row['HoTen'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Giới tính:</label>
                <select name="gioitinh" class="form-select">
                    <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày sinh:</label>
                <input type="date" name="ngaysinh" class="form-control" value="<?= $row['NgaySinh'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Ngành:</label>
                <select name="manganh" class="form-select" required>
                    <?php while ($nganh = $result_nganh->fetch_assoc()) { ?>
                        <option value="<?= $nganh['MaNganh'] ?>" <?= $nganh['MaNganh'] == $row['MaNganh'] ? 'selected' : '' ?>>
                            <?= $nganh['MaNganh'] ?> - <?= $nganh['TenNganh'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình ảnh hiện tại:</label><br>
                <img src="Content/images/<?= $row['Hinh'] ?>" id="preview" width="100" style="border: 1px solid #ddd; padding: 5px;">
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn hình ảnh mới:</label>
                <input type="file" name="hinhanh" class="form-control" onchange="previewImage(event)">
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
