<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah</title>
    <style>
        .result {
            font-size: 18px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <h2 id="ubahText">HALLO</h2>
    <button onclick="ubahTeks()">Ubah Teks</button>
    <script>
        function ubahTeks() {
            var elemenTeks = document.getElementById("ubahText");
            elemenTeks.innerHTML = "TEKS YANG DIUBAH";
            elemenTeks.classList.add("result");
        }
    </script>
</body>
</html>
