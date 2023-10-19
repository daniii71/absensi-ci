<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Absensi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
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
        width: 10px;
        padding: 15px;
        text-align: center;
        border: 10px solid #ccc;
        /* Mengubah ketebalan garis disini */
        background-color: #f9f9f9;
        border-radius: 10px;
        margin: 20px;
        transition: transform 0.3s;
    }


    .card:hover {
        transform: scale(1.05);
    }

    .table {
        margin-top: 5px;
    }

    h2 {
        color: #333;
    }

    p {
        font-size: 5px;
        color: #007BFF;
        margin: 5px 0;
    }
    </style>
</head>

<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="absensi-container">
                    <h2 class="mb-4">Menu Absensi</h2>
                    <form action="<?= base_url('employee/aksi_absensi'); ?>" method="post">
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="form-control" id="kegiatan" name="kegiatan" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Absensi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tautan Bootstrap dan SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.js"></script>
    <script src="path/to/your/custom.js"></script>

    <!-- JavaScript untuk menampilkan pesan sukses -->
    <script>
    <?php if ($this->session->flashdata('success')) : ?>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?= $this->session->flashdata('success') ?>'
    });
    <?php endif; ?>
    </script>
</body>

</html>