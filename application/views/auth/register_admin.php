<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/2.2.16/tailwind.min.css">
    <style>
        body {
            background-image: url('your-background-image-url.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .admin {
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
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            color: #fff;
        }

        .register-link {
            color: #007BFF;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">REGISTER ADMIN</h1>
        <p class="admin">register sebagai Admin</p>
        <form action="<?php echo base_url(); ?>Auth/aksi_register_admin" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" />
                <input type="email" name="email" id="email" placeholder="Email" />
                <input type="text" name="nama_depan" id="nama_depan" placeholder="Nama Depan" />
                <input type="text" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang" />
                <input type="password" name="password" id="password" placeholder="Password" />
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <p class="message">
                <a href="<?php echo base_url('auth'); ?>">Login</a>
            </p>
            <p class="message">
                <a href="<?php echo base_url('auth/register'); ?>">Register as User</a>
            </p>
        </form>
    </div>
</body>

</html>
