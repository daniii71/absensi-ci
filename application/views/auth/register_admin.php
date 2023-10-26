<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/2.2.16/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha384-###" crossorigin="anonymous">

    <style>
    body {
        background-image: url('https://asset.kompas.com/crops/oUbd-oWgmK9GQitYBij1i8DX-1Y=/0x73:1280x713/750x500/data/photo/2019/07/24/5d37bf7ba9d0f.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    .container {
        max-width: 385px;
        margin: 0 auto;
        padding: 25px;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .karyawan {
        text-align: center;
    }


    .title {
        text-align: center;
        color: #fff;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        border: none;
        color: #fff;
        border-radius: 15px;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0d6efd;
    }

    .message {
        text-align: center;
        color: #fff;
    }

    .message a {
        color: red;
        /* Ganti dengan warna yang Anda inginkan */
    }

    .register-link {
        color: #007BFF;
        text-decoration: none;
    }

    .register-link:hover {
        text-decoration: underline;
    }

    /* ... CSS lainnya ... */

    /* Gaya untuk ikon mata terbuka */
    .toggle-password.fa-eye {
        position: absolute;
        right: 3px;
        top: 50%;
        transform: translateY(-80%);
        cursor: pointer;
        color: #007BFF;
        /* Warna ikon mata terbuka */
    }

    /* Gaya untuk ikon mata tertutup */
    .toggle-password.fa-eye-slash {
        position: absolute;
        right: 3px;
        top: 50%;
        transform: translateY(-80%);
        cursor: pointer;
        color: #777;
        /* Warna ikon mata tertutup */
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">REGISTER ADMIN</h1>
        <form action="<?php echo base_url(); ?>Auth/aksi_register_admin" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required />
                <input type="email" name="email" id="email" placeholder="Email" required />
                <input type="text" name="nama_depan" id="nama_depan" placeholder="Nama Depan" required />
                <input type="text" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang" required />
                <div style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="Password" required />
                    <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i>
                </div>
                <p style="color: blue;">password minimal 8</p>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <p class="message">
                <a href="<?php echo base_url('auth'); ?>">Login</a>
            </p>
            <p class="message">
                <a href="<?php echo base_url('auth/register'); ?>">Register karyawan</a>
            </p>
        </form>
    </div>
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    }
    </script>

</body>

</html>