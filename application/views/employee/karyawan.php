<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

.main {
    padding: 20px;
}

.card {
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
}

.table {
    width: 10%;
    margin-top: 10px;
    margin-left: 70px;
}

@media (max-width: 8px) {
    .table {
        margin-left: 10%;
    }
}
</style>

<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <i class="fas fa-check fa-4x icon float-end"></i>
                        <h6 class="card-title">
                            Jumlah Masuk</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <i class="fas fa-envelope fa-4x icon float-end"></i>
                        <h6 class="card-title">
                            Jumlah Izin</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <i class="fa-solid fa-calculator fa-4x icon float-end"></i>
                        <h6 class="card-title">
                            Total</h6>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kegiatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Pulang</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php if (isset($absensi)) : ?>
                <?php foreach ($absensi as $row) : ?>
                <tr>
                    <td><span class="number"><?php echo $i; ?></span></td>
                    <td><?php echo $row->kegiatan; ?></td>
                    <td><?php echo $row->tanggal; ?></td>
                    <td><?php echo $row->jam_masuk; ?></td>
                    <td>
                        <span id="jam-pulang-<?php echo $i; ?>">
                            <?php echo $row->jam_pulang; ?>
                        </span>
                    </td>
                    <td>
                        <?php if (!empty($row->keterangan_izin)) : ?>
                        <?php echo $row->keterangan_izin; ?>
                        <?php else : ?>
                        <?php echo $row->kegiatan; ?>
                        <?php endif; ?>
                    </td>
                    <?php $i++; ?>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr>
                    <td colspan="6">No data available</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>