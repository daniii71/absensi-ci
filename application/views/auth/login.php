<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha384-###" crossorigin="anonymous">

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

    /* Gaya untuk ikon mata terbuka */
    .toggle-password.fa-eye {
        position: absolute;
        right: 37px;
        top: 60%;
        transform: translateY(-85%);
        cursor: pointer;
        color: #007bff;
        /* Warna ikon mata terbuka */
    }

    /* Gaya untuk ikon mata tertutup */
    .toggle-password.fa-eye-slash {
        position: absolute;
        right: 37px;
        top: 60%;
        transform: translateY(-85%);
        cursor: pointer;
        color: #777;
        /* Warna ikon mata tertutup */
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
                        <label for="email" class="block mb-2 text-sm text-center" style="color: black;"><i
                                class="fa-solid fa-envelope-open-text"></i>
                            Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="text-sm" style="color: black;">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                        <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i>
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

    <script>
    function validateForm() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword'); // Tambahkan ini

        if (emailInput.value === '' || passwordInput.value === '' || confirmPasswordInput.value === '') {
            alert('Email, password, and confirm password must be filled out');
            return false; // Form submission will be prevented
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            alert('Password and confirm password must match');
            return false; // Form submission will be prevented
        }

        // If the form is valid, it will be submitted
        return true;
    }
    </script>




</body>

</html>