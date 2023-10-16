<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Mingguan</title>
    <!-- Tambahkan tag-head Anda di sini, seperti CSS dan JavaScript yang dibutuhkan -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Tambahkan link CSS khusus jika diperlukan -->
</head>
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

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 5px solid #ddd;
            }

            th, td {
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #007BFF;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
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
<body>
    <?php $this->load->view('component/sidebar_admin'); ?>
    <div class="min-vh-100 d-flex py-2 justify-content-center">
        <div class="col-md-9">
            <h2>Rekap Mingguan</h2>

            <!-- Filter Tanggal -->
            <form action="<?= base_url('admin/rekap_mingguan'); ?>" method="get">
                <div class="form-group">
                    <input type="week" class="form-control" id="tanggal" name="tanggal">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Pulang</th>
                        <th>Izin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absensi as $no => $rekap): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $rekap['kegiatan']; ?></td>
                            <td><?= $rekap['tanggal']; ?></td>
                            <td><?= $rekap['masuk_absen']; ?></td>
                            <td><?= $rekap['pulang_absen']; ?></td>
                            <td><?= $rekap['izin_absen']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tambahkan tag-script Anda di sini, seperti JavaScript yang dibutuhkan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tambahkan link JavaScript khusus jika diperlukan -->
</body>
</html>
