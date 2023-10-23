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
        <ul>
            <li><a href=""><i class="fa-solid fa-anchor-lock"></i>
                    Dashboard Karyawan</a></li>
            <br>
            <li><a href="dashboard"><i class="fa-solid fa-id-card-clip"></i>
                    Dashboard</a></li>
            <br>
            <li><a href="absensi"><i class="fa-solid fa-id-card-clip"></i>
                    Absensi</a></li>
            <br>
            <li><a href="menu_absensi"><i class="fa-solid fa-id-card-clip"></i>
                    menu Absensi</a></li>
            <br>
            <li><a href="menu_izin"><i class="fa-solid fa-id-card-clip"></i>
                    menu izin</a></li>
            <br>
            <li><a href="profile"><i class="fa-solid fa-id-card-clip"></i>
                    profile</a></li>
            <br>
            <!-- Tambahkan tautan-tautan lain sesuai kebutuhan -->
            <li><button onclick="confirmLogout()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout</button></li>
        </ul>
    </div>

    <!-- Konten utama -->
    <div class="content">
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