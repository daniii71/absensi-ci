<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profile.css'); ?>">
</head>
<style>
    /* custom.css */

    /* Styling untuk card */
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Header card */
    .card-header {
        background-color: #f0f0f0;
        border-bottom: 1px solid #e0e0e0;
    }

    /* Body card */
    .card-body {
        padding: 20px;
    }

    /* Gambar dalam card */
    .card-body img {
        max-width: 100%;
        border-radius: 50%;
    }

    /* Tombol sekunder */
    .btn-secondary {
        background-color: #ccc;
        color: #000;
    }

    /* Tombol utama */
    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }


</style>

<body>
    <?php $this->load->view('component/sidebar_karyawan'); ?>
    <div class="main m-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4">
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            Foto Profil
                        </div>
                        <div class="card-body text-center">
                            <?php foreach ($akun as $user) : ?>
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="<?php echo base_url('assets/images/user/' . $user->image) ?>" alt="">
                                <p class="text-muted">Harus berbentuk jpg|jpeg|png</p>
                                <p class="text-muted">Disarankan Foto </p>
                                <form action="<?php echo base_url('employee/edit_foto'); ?>" method="post" enctype="multipart/form-data">
                                    <label for="image_upload" class="btn btn-secondary">
                                        Edit Foto
                                        <input type="file" id="image_upload" name="userfile" style="display: none;">
                                    </label>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            Informasi Data
                        </div>
                        <div class="card-body">
                            <?php foreach ($akun as $user) : ?>
                                <form action="<?php echo base_url('employee/edit_profile'); ?>" enctype="multipart/form-data" method="post">

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Masukan email"
                                            value="<?php echo $user->email ?>" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for "username" class="form-label">Username</label>
                                        <input class="form-control" id="username" type="text" placeholder="Masukan username"
                                            value="<?php echo $user->username ?>" name="username">
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="nama_depan" class="form-label">Nama Depan</label>
                                            <input class="form-control" id="nama_depan" type="text"
                                                placeholder="Masukan nama depan" value="<?php echo $user->nama_depan ?>"
                                                name="nama_depan">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                            <input class="form-control" id="nama_belakang" type="text"
                                                placeholder="Masukan nama belakang"
                                                value="<?php echo $user->nama_belakang ?>" name="nama_belakang">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control" id="password" type="password" placeholder="Masukkan password" name="password">
                                        </div>
                                        <div class="mb-3">
                                        <label for="image_upload" class="form-label">Foto Profil</label>
                                        <input type="file" id="image_upload" name="image" accept="image/jpeg, image/jpg, image/png">
                                    </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                                </form>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
