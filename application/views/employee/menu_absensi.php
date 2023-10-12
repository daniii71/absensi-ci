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
        .absensi-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
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
                    <form action="<?= base_url('employee/menu_absensi'); ?>" method="post">
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
