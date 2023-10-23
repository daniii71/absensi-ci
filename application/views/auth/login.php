<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lakukan validasi di sini, misalnya dengan memeriksa kecocokan email dan password dengan database atau penyimpanan yang sesuai.

    // Contoh validasi sederhana, Anda harus menggantinya dengan validasi yang lebih aman:
    if ($email === 'contoh@email.com' && $password === 'katasandi') {
        // Login sukses, arahkan ke halaman selanjutnya
        header('Location: dashboard.php');
    } else {
        // Login gagal, kembalikan ke halaman login dengan pesan kesalahan
        header('Location: login.php?error=1');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    body {
        background-image: url('https://asset.kompas.com/crops/dvKdOLNHcM_EYM_j8G-W3laiZQU=/2x0:800x532/750x500/data/photo/2022/08/23/630482c63af5e.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .card-title {
        color: #fff;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 20px;
        width: 40%;
    }

    .card.left {
        order: 1;
    }

    .card.right {
        order: 2;
    }

    .logo {
        max-width: 100px;
        height: auto;
        display: block;
        margin: 0 auto 20px;
    }

    .custom-button {
        font-size: 20px;
        width: 200px;
    }

    .footer {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10px;
        color: #fff;
    }

    .ddd {
        text-align: center;
    }

    /* Menambahkan gaya khusus untuk perangkat seluler */
    @media (max-width: 768px) {
        .card {
            padding: 10px;
        }

        .custom-button {
            width: 100%;
        }
    }
    </style>

</head>

<body class="body">
    <div class="container">
        <div class="card mt-5 mx-auto">
            <h3 class="card-header mx-auto text-fold text-center" style="color: red;"><strong>LOGIN</strong></h3>
            <div class="card-body">
                <form action="<?php echo base_url(); ?>auth/aksi_login" method="post" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label for="email" class="block mb-2 text-sm text-center" style="color: blue;">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="text-sm" style="color: blue;">Password</label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary custom-button">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="<?php echo base_url(); ?>auth/register">Register here</a>
            </div>
        </div>
    </div>

    <script>
    function validateForm() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        if (emailInput.value === '' || passwordInput.value === '') {
            alert('Email and password must be filled out');
            return false; // Form submission will be prevented
        }

        // If the form is valid, it will be submitted
        return true;
    }
    </script>

</body>

</html>