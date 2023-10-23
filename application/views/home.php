<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('https://asset.kompas.com/crops/T3BK9gGBxjdwRBJzXv9xfeERI3c=/83x0:707x416/750x500/data/photo/2020/08/30/5f4b2fa3709bc.jpg');
        background-size: cover;
        background-color: blue;
        background-position: center;
        text-align: center;
        padding: 200px;
        margin: 20;
    }

    h1 {
        color: #fff;
        font-size: 50px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .custom-button {
        padding: 12px 22px;
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 20px;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-button.login {
        background-color: #007bff;
    }

    .custom-button.register {
        background-color: #28a745;
    }

    .custom-button:hover {
        transform: translateY(-2px);
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>

<body>
    <h1>Background Text</h1> <!-- Mengganti teks "bacroun text" menjadi "Background Text" -->
    <div class="button-container">
        <a href="./auth" class="custom-button login">LOGIN</a>
        <br>
        <a href="./auth/register" class="custom-button register">REGISTER</a>
    </div>
</body>

</html>