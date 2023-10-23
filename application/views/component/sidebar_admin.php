<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


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
        margin-left: 270px;
        /* Sesuaikan dengan lebar sidebar */
        padding: 20px;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha384-lzrdBbdpDNwjjOT4FJITelfn3fQC3TWc3uzv5Hd2N+g8i6i+oZtEIVIzKG90PdpWk" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="dashboard-nav-list">
            <br>
            <a href="<?= base_url('admin'); ?>" class="dashboard-nav-item">
                <i class="fa-solid fa-gauge"></i>index
            </a>
            <br>
            <br>
            <a href="<?= base_url('admin/daftar_karyawan'); ?>" class="dashboard-nav-item">
                <i class="fa-solid fa-briefcase"></i> Karyawan
            </a>
            <br>
            <br>
            <a href="<?= base_url('admin/rekap_bulanan'); ?>" class="dashboard-nav-item">
                <i class="fa-solid fa-fax"></i> Rekapan Bulanan
            </a>
            <br>
            <br>
            <a href="<?= base_url('admin/rekap_harian'); ?>" class="dashboard-nav-item">
                <i class="fa-solid fa-recycle"></i> Rekapan Harian
            </a>
            <br>
            <br>
            <a href="<?= base_url('admin/rekap_mingguan'); ?>" class="dashboard-nav-item">
                <i class="fa-solid fa-book-open-reader"></i> Rekapan Mingguan
            </a>
            <br>
            <br>
            <a href="<?= base_url('admin/profile'); ?>" class="dashboard-nav-item">
                <i class="fa-regular fa-user"></i> Profile
            </a>
            <br>
            <br>
            <br>
            <li><button onclick="confirmLogout()">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
        </nav>
    </div>

    <!-- Konten utama -->
    <div class="content">
        <!-- Isi konten utama halaman di sini -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- LOGOUT -->
    <script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin mau LogOut?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('/') ?>";
            }
        });
    }
    </script>
</body>

</html>