<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-TwpyMehNlfFp1z7buNhoyzujzRkKBCuJSMbJItF8O1xyn4D3Mn+C2F5nHnuKvF5t2" crossorigin="anonymous">
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
    <div class="w-75 m-4">
        <div class="container w-75">
            <div class="row justify-content-between mb-3">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total User</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between">
                                <i class="fa-solid fa-user-graduate"></i>
                                Usernya
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total Karyawan</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between">
                                <i class="fa-solid fa-users"></i>
                                Karyawan
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total Absen</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between">
                                <i class="fa-regular fa-calendar-days"></i>
                                Hari
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Histori Absen</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan Izin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach ($absensi as $row) : $no++; ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row->kegiatan ?></td>
                                    <td><?php echo $row->tanggal ?></td>
                                    <td><?php echo $row->jam_masuk ?></td>
                                    <td><?php echo $row->jam_pulang ?></td>
                                    <td><?php echo $row->keterangan_izin ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>