<?php
include 'config.php';

// Truy vấn lấy dữ liệu sinh viên và ngành học
$result = $conn->query("SELECT SinhVien.MaSV, SinhVien.HoTen, SinhVien.GioiTinh, SinhVien.NgaySinh, SinhVien.Hinh, NganhHoc.MaNganh FROM SinhVien LEFT JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #343a40 !important; }
        .navbar .nav-link { color: #fff !important; }
        h2 { color: #343a40; }
        .table-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .student-img { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Sinh viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hocphan.php">Học phần</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Danh sách sinh viên -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Danh sách sinh viên</h2>
    <a href="create.php" class="btn btn-primary mb-3">Thêm sinh viên</a>
    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Hình</th>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Mã Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php 
                            $imagePath = "Content/images/" . htmlspecialchars($row['Hinh']);
                            if (!empty($row['Hinh']) && file_exists($imagePath)) {
                                echo '<img src="' . $imagePath . '" alt="Sinh viên" class="student-img">';
                            } else {
                                echo '<img src="Content/images/default.png" alt="Không có ảnh" class="student-img">';
                            }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($row['MaSV']) ?></td>
                        <td><?= htmlspecialchars($row['HoTen']) ?></td>
                        <td><?= htmlspecialchars($row['GioiTinh']) ?></td>
                        <td><?= htmlspecialchars($row['NgaySinh']) ?></td>
                        <td><?= htmlspecialchars($row['MaNganh']) ?></td>
                        <td>
                            <a href="detail.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-info btn-sm">Xem</a>
                            <a href="edit.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="delete.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
