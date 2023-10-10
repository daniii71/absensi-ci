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
            background-image: url('background.jpg'); /* Ganti 'background.jpg' dengan URL gambar latar belakang yang kamu inginkan */
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
        }

        .card.left {
            order: 1; /* Menempatkan kartu login ke kiri */
        }

        .card.right {
            order: 2; /* Menempatkan kartu register ke kanan */
        }

        .logo {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 40px;
        }

        .custom-button {
            font-size: 18px; /* Ubah ukuran font sesuai preferensi */
            width: 150px;
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            color: #fff;
        }

        .ddd {
            text-align: center;
        }
    </style>
</head>

<body class="body">
    <div class="container">

        <div class="card mt-5 w-50 mx-auto">
            <h3 class="card-header mx-auto text-fold text-center" style="color: red;"><strong>LOGIN</strong></h3>
            <div class="card-body">
                <form action="<?php echo base_url(); ?>auth/aksi_login" method="post">
                    <div class="mb-3">
                        <label for="email" class="block mb-2 text-sm text-center" style="color: black;">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="text-sm" style="color: black;">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                         autocomplete="off">
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary custom-button">Login</button>
                    </div> 
                </form>
            </div>
            <div class="card-footer text-center">
            <p>Don't have an account? <a href="<?php echo base_url(); ?>auth/register">Register here</a></p>
        </div>
        </div>
    </div>
</body>

</html>
