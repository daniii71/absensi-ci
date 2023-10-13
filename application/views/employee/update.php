<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Karyawan</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <style>
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            width: 400px;
            padding: 20px;
            text-align: center;
        }

        .card-header {
            background-color: #007BFF;
            color: #fff;
            padding: 15px;
        }

        h5 {
            margin: 0;
        }

        #karyawanName {
            font-size: 30px;
            margin: 20px 0;
        }

        .btn-primary {
            background-color: #007BFF;
            border: none;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        input[type="text"] {
            width: 100%;    
            padding: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="card">
            <div class="card-header">
                <h5>Ubah Karyawan</h5>
            </div>
            <div class="card-body">
                <h2 id="karyawanName">John Doe</h2>
                <form id="updateForm" onsubmit="updateKaryawan(event)">
                    <div class="form-group">
                        <input type="text" id="newName" placeholder="Masukkan nama karyawan baru" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Karyawan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateKaryawan(event) {
            event.preventDefault();
            var elemenKaryawan = document.getElementById("karyawanName");
            var namaBaru = document.getElementById("newName").value;

            if (namaBaru) {
                elemenKaryawan.innerHTML = "Nama Karyawan: " + namaBaru;
            }
        }
    </script>
</body>
</html>
