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
                <form class="row" action="<?php echo base_url('employee/aksi_izin'); ?>"
                        enctype="multipart/form-data" method="post">
                        <div class="mb-3 col-12">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" aria-label="With textarea" name="keterangan_izin"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" name="submit">Izin</button>
                        </div>
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
