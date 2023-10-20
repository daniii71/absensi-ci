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

img {
    width: 50%;
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
    <div class="main m-4">
        <div class="container w-75">
            <div class="card-body">
                <div class="row">
                    <?php foreach($akun as $user) : ?>
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Foto Profil</div>
                            <div class="card-body text-center">
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="<?php echo base_url('assets/images/user/' .$user->image) ?>" alt="">
                                <div class="small font-italic text-muted"></div>
                                <p class="small font-italic text-muted mb-4">Disarankan foto</p>
                                <form action="<?php echo base_url('admin/edit_foto'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <label for="image_upload" class="btn btn-success">
                                        Edit Foto
                                        <input type="file" id="image_upload" name="userfile" style="display: none;">
                                    </label>
                                    <button type="submit" class="btn btn-secondary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Info Data</div>
                            <div class="card-body">
                                <form action="<?php echo base_url('admin/edit_profile'); ?>"
                                    enctype="multipart/form-data" method="post">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Masukan email"
                                            value="<?php echo $user->email ?>" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control" id="username" type="text"
                                            placeholder="Masukan username" value="<?php echo $user->username ?>"
                                            name="username">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_depan">Nama Depan</label>
                                            <input class="form-control" id="nama_depan" type="text"
                                                placeholder="Masukan nama depan" value="<?php echo $user->nama_depan ?>"
                                                name="nama_depan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_belakang">Nama Belakang</label>
                                            <input class="form-control" id="nama_belakang" type="text"
                                                placeholder="Masukan nama belakang"
                                                value="<?php echo $user->nama_belakang ?>" name="nama_belakang">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="password">Password lama</label>
                                            <div class="input-group">
                                                <input class="form-control" id="password" type="password"
                                                    placeholder="Password lama" name="password_lama">
                                                <span class="input-group-text" onclick="togglePassword('password')"><i
                                                        id="icon-password" class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="password">Password Baru</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="password" type="password"
                                                        placeholder="Masukan password baru" name="password_baru">
                                                    <span class="input-group-text"
                                                        onclick="togglePassword('password')"><i id="icon-password"
                                                            class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="password">Konfirmasi Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="konfirmasi_password" type="password"
                                                        placeholder="Konfirmasi password" name="konfirmasi_password">
                                                    <span class="input-group-text"
                                                        onclick="togglePassword('konfirmasi_password')"><i
                                                            id="icon-konfirmasi" class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Simpan </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>