<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <!-- Tambahkan tag-head Anda di sini, seperti CSS dan JavaScript yang dibutuhkan -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
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

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
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
    </style>

<body>
    <?php $this->load->view('component/sidebar_admin'); ?>
        <div class="comtainer-fluid">
                <h2>Daftar Karyawan</h2>
                    <table class="table"> 
                        <thead>
                            <tr>
                            <th style="width: 50px;">ID</th>
                            <th style="width: 200px;">Nama</th>
                            <th style="width: 150px;">Email</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php $no = 0; foreach($absensi as $row) : $no++; ?>
                    <tr class="text-center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['id_karyawan']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['kegiatan']; ?></td>
                        <td><?php echo $row['keterangan_izin']; ?></td>
                        <td><?php echo $row['jam_masuk']; ?></td>
                        <td><?php echo $row['jam_pulang']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                </table>                          
        </div>
        <!-- Tambahkan tag-script Anda di sini, seperti JavaScript yang dibutuhkan -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="path/to/your/custom.js"></script>
</body>
</html>