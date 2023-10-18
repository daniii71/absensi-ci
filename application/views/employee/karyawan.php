<?php
$absensi = 10; // You can replace 10 with the actual value you want to display.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .main {
        margin-left: 20%;
        padding: 20px;
    }

    .card {
        text-align: center;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 10px;
        padding: 20px;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    h5 {
        color: #333;
    }

    h4 {
        font-size: 24px;
        color: #007BFF;
        margin: 10px 0;
    }
    </style>
</head>

<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>

    <div class="main">
        <div class="container w-75">
            <div class="row justify-content-center">
                <?php
                // Card data
                $cards = [
                    [
                        'title' => 'Masuk Kerja',
                        'value' => '6 Hari',
                    ],
                    [
                        'title' => 'Izin Kerja',
                        'value' => '1 Hari',
                    ],
                    [
                        'title' => 'Total',
                        'value' => $absensi . ' Hari',
                    ],
                ];

                foreach ($cards as $card) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $card['title']; ?></h5>
                        </div>
                        <div class="card-body">
                            <h4><?php echo $card['value']; ?></h4>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>