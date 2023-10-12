<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izin</title> <!-- Judul menu diubah menjadi "Izin" -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>
<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-4">Izin</h2> <!-- Judul menu diubah menjadi "Izin" -->
                <form action="<?= base_url('employee/menu_izin'); ?>" method="post" class="mt-3">
                    <div class="mb-3">
                        <label for="keterangan_izin" class="form-label">Keterangan Izin</label> <!-- Penulisan label yang lebih konsisten -->
                        <textarea class="form-control" id="keterangan_izin" name="keterangan_izin" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Izin</button> <!-- Teks tombol diubah menjadi "Izin" -->
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/custom.js"></script>
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
