<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .dashboard {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 50px;
        transform: translateY(-20px);
        transition: transform 0.5s;
    }

    .card {
        width: 170px;
        padding: 25px;
        text-align: center;
        border: 35px solid #ccc;
        /* Mengubah ketebalan garis disini */
        background-color: #f9f9f9;
        border-radius: 20px;
        margin: 25px;
        transition: transform 0.3s;
    }


    .card:hover {
        transform: scale(1.05);
    }

    .table {
        margin-top: 100px;
    }

    h2 {
        color: #333;
    }

    p {
        font-size: 25px;
        color: #007BFF;
        margin: 25px 0;
    }
    </style>
</head>

<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>
    <div class="dashboard w-75">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <p id="jumlahMasuk">6</p>
                    <i class="fa-solid fa-user "></i>
                    Jumlah Masuk
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <p id="jumlahIzin">5</p>
                    <i class="fas fa-calendar-days"></i>
                    Jumlah Izin
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <p id="jumlahTotal">0</p>
                    <i class="fas fa-calculator"></i>
                    Total
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Keterangan Izin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($absensi) && is_array($absensi)): ?>
                    <?php $no = 0; ?>
                    <?php foreach ($absensi as $row): ?>
                    <?php $no++; ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row->kegiatan; ?></td>
                        <td><?php echo $row->tanggal; ?></td>
                        <td><?php echo $row->jam_masuk; ?></td>
                        <td><?php echo $row->jam_pulang; ?></td>
                        <td><?php echo $row->keterangan_izin; ?></td>
                        <td><?php echo $row->status; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7">No data available.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    // JavaScript to calculate and display the total
    const jumlahMasukElement = document.getElementById('jumlahMasuk');
    const jumlahIzinElement = document.getElementById('jumlahIzin');
    const jumlahTotalElement = document.getElementById('jumlahTotal');

    const jumlahMasuk = parseInt(jumlahMasukElement.textContent, 10);
    const jumlahIzin = parseInt(jumlahIzinElement.textContent, 10);
    const jumlahTotal = jumlahMasuk + jumlahIzin;

    jumlahTotalElement.textContent = jumlahTotal;
    </script>
</body>

</html>