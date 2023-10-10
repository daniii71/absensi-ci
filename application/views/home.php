<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('');
            background-size: cover;
            background-position: center;
            text-align: center;
            padding: 100px;
            margin: 0;
        }

        h1 {
            color: #fff;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .custom-button {
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
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
    <h1>bacroun text</h1> <!-- Mengganti teks "Welcome Dhani" menjadi "bacroun text" -->
    <div class="button-container">
        <a href="./auth" class="custom-button login">LOGIN</a>
        <a href="./auth/register" class="custom-button register">REGISTER</a>
    </div>
</body>
</html>
