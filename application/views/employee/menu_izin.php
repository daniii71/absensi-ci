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

<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-4">Izin</h2> <!-- Judul menu diubah menjadi "Izin" -->
                <form class="row" action="<?php echo base_url('employee/aksi_izin'); ?>" enctype="multipart/form-data"
                    method="post">
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