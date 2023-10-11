<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS kustom untuk tampilan sidebar -->
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 15px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .content {
            margin-left: 270px; /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="dashboard_karyawan">Dashboard Karyawan</a></li>
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="absensi">Absensi</a></li>
            <!-- Tambahkan tautan-tautan lain sesuai kebutuhan -->
            <li><a href="logout">Logout</a></li> <!-- Tambahkan tautan Logout -->
        <!-- Tambahkan tautan-tautan lain sesuai kebutuhan -->
        </ul>
    </div>

    <!-- Konten utama -->
    <div class="content">
        <!-- Isi konten utama halaman di sini -->
    </div>
</body>
</html>
