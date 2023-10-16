<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-TwpyMehNlfFp1z7buNhoyzujzRkKBCuJSMbJItF8O1xyn4D3Mn+C2F5nHnuKvF5t2" crossorigin="anonymous">

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

<div class="absensi-container" style="width: 80%;">
    <div class="col-md-9">
        <h2>DATA ABSEN</h2>
        <br>
        <table class="table" style="width: 130%;">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0; foreach($absensi as $row): $no++; ?>
                <tr class="text-center">
                    <td><?php echo $no  ?></td>
                    <td><?php echo $row->tanggal ?></td>
                    <td><?php echo $row->jam_masuk ?></td>
                    <td><?php echo $row->jam_pulang ?></td>
                    <td><?php echo $row->status ?></td>
                    <td>
                        <?php if ($row->status == 'done'): ?>
                            Izin
                        <?php else: ?>
                            <a href="<?php echo base_url('employee/pulang/' . $row->id); ?>" class="btn btn-success" id="pulangButton_<?php echo $row->id; ?>"><i class="fa-solid fa-people-pulling"></i></a>
                            <h1 class="card-title">
                            <a href="<?php echo base_url('employee/update_absen/'). $row->id; ?>">
                                <i class="fas fa-pencil-alt"></i> <!-- Ganti dengan kelas ikon yang sesuai -->
                            </a>
                        </h1>

                            <button class="btn btn-danger" onclick="confirmDelete(<?php echo $row->id; ?>)"><i class="fa-solid fa-trash-can"></i></button>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
<script>
    <?php foreach ($absensi as $row): ?>
        var absensiId = <?php echo $row->id; ?>;
        var status = '<?php echo $row->status; ?>';
        disablePulangButton(absensiId, status);
    <?php endforeach; ?>

    function showSweetAlert(message) {
        Swal.fire({
            icon: 'info',
            text: message,
            showConfirmButton: false,
            timer: 2000
        });
    }

    function disablePulangButton(absenId, status) {
        var pulangButton = document.getElementById("pulangButton_" + absenId);
        if (status === 'pulang') {
            pulangButton.classList.add("disabled");
            pulangButton.removeAttribute("href");
        }
    }
</script>
<script>
function hapus(id) {
    if (confirm('Yakin Di Hapus?Di Hapus Tenan kiii!')) {
        // Jika pengguna mengonfirmasi, maka akan menjalankan perintah hapus
        window.location.href = "<?php echo base_url('employee/hapus/'); ?>" + id;
    }
}
</script>
</body>
</html>
