<?php
include 'config.php';
$result = $conn->query("SELECT * FROM hocphan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        <h2 class="text-center">DANH SÁCH HỌC PHẦN</h2>
        
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Đăng Kí</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['MaHP'] ?></td>
                        <td><?= $row['TenHP'] ?></td>
                        <td><?= $row['SoTinChi'] ?></td>
                        <td>
                            <a href="dangkyhocphan.php?MaHP=<?= $row['MaHP'] ?>" class="btn btn-success">Đăng Kí</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>