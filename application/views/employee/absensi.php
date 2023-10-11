<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .absensi-container {
            text-align: center;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        .result {
            font-size: 18px;
            color: #28a745;
        }
    </style>
</head>
<body>
<?php $this->load->view('./component/sidebar_karyawan'); ?>

    <div class="absensi-container">
        <h1>Absensi Karyawan</h1>
        <button onclick="absen()">Absen</button>
        <p>Status Absensi:</p>
        <p class="result" id="statusAbsen"></p>
    </div>

    <script>
        function absen() {
            const statusAbsenElement = document.getElementById('statusAbsen');
            statusAbsenElement.textContent = 'Anda berhasil absen.';
        }
    </script>
</body>
</html>
