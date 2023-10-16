<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Karyawan</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<?php $this->load->view('component/sidebar_karyawan'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Ubah Absensi</h1>
                        <?php foreach($absensi as $absen): ?>
                    <form class="row" action="<?php echo base_url('karyawan/aksi_update_absen'); ?>"
                        enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="<?php echo $absen->id ?>">
                        <div class="mb-3 col-12">
                            <label for="Kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="form-control" aria-label="With textarea"
                                name="kegiatan"><?php echo $absen->kegiatan ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-danger" href="javascript:history.go(-1)">Kembali</a>
                            <button type="submit" class="btn btn-success" name="submit">Edit</button>
                        </div>
                    </form>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/custom.js"></script>
</body>
</html>
