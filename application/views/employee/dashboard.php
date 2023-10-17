<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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

        .dashboard {
            /* display: flex; */
            justify-content: space-around;
            align-items: center;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transform: translateY(-20px); /* Geser ke atas 20px */
            transition: transform 0.5s; /* Animasi 0.5 detik */
        }

        .card {
            width: 200px;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin: 10px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .table{
            margin-top: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 24px;
            color: #007BFF;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<?php $this->load->view('./component/sidebar_karyawan'); ?>
<div class="dashboard w-75">
    <div class="d-flex justify-content-between">
        <div class="card">
            <p id="jumlahMasuk">100</p>
            <i class="fa-solid fa-check"></i>
            Jumlah Masuk
        </div>
        <div class="card">
            <p id="jumlahIzin">25</p>
            <i class="fa-solid fa-calendar-days"></i>
            Jumlah Izin
        </div>
        <div class="card">
            <p id="jumlahTotal">0</p>
            <i class="fa-solid fa-calculator"></i>
            Total
        </div>
    </div>
    <div class="table-responsive"> 
                        <table class="table table-bordered"> 
 
                            <thead class="table-dark"> 
                                <tr> 
                                    <th>No</th> 
                                    <th>Nama</th> 
                                    <th>Kegiatan</th> 
                                    <th>Jam Masuk</th> 
                                    <th>Jam Pulang</th> 
                                    <th>Keterangan Izin</th> 
                                    <th>Status</th> 
 
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php $no = 0; 
                                    foreach ($absensi as $row): 
                                        $no++ ?> 
                                <tr> 
                                    <td> 
                                        <?php echo $no ?> 
                                    </td> 
                                    <td> 
                                        <?php echo tampil_full_nama_byid($row->id_karyawan) ?> 
                                    </td> 
                                    <td> 
                                        <?php echo $row->kegiatan ?> 
                                    </td> 
                                    <td> 
                                        <?php echo $row->jam_masuk ?> 
                                    </td> 
                                    <td> 
                                        <?php echo $row->jam_pulang ?> 
                                    </td> 
                                    <td><?php echo $row->keterangan_izin ?></td> 
                                    <td> 
                                        <?php echo $row->status?> 
                                    </td> 
 
                                </tr> 
                                <?php endforeach ?> 
 
                            </tbody> 
                        </table> 
                    </div>

        <script>
        // Mengambil nilai jumlah masuk dan jumlah izin dari elemen HTML
        const jumlahMasukElement = document.getElementById('jumlahMasuk');
        const jumlahIzinElement = document.getElementById('jumlahIzin');
        const jumlahTotalElement = document.getElementById('jumlahTotal');

        // Menghitung jumlah total
        const jumlahMasuk = parseInt(jumlahMasukElement.textContent, 10);
        const jumlahIzin = parseInt(jumlahIzinElement.textContent, 10);
        const jumlahTotal = jumlahMasuk + jumlahIzin;

        // Menampilkan jumlah total dalam elemen HTML
        jumlahTotalElement.textContent = jumlahTotal;
    </script>
</body>
</html>
