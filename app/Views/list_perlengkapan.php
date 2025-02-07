<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Perlengkapan</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f1fafb;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #40BFC1;
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin: 20px auto;
            width: 60%;
            border-radius: 5px;
            font-size: 0.95rem;
            font-weight: bold;
            text-align: center;
            border-left: 5px solid;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .alert-success {
            background-color: #e6f7f7;
            color: #2b807f;
            border-left-color: #40BFC1;
        }
        .alert-danger {
            background-color: #fdeaea;
            color: #a94442;
            border-left-color: #ff6b6b;
        }
        table {
            width: 60%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        table thead {
            background-color: #40BFC1;
            color: #fff;
        }
        table thead th {
            padding: 12px;
            text-align: center;
            font-size: 1rem;
        }
        table tbody td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 0.95rem;
        }
        table tbody tr:hover {
            background-color: #f1fafb;
        }
        .add-button {
            display: block;
            width: fit-content;
            margin: 0 auto 20px;
            background-color: #40BFC1;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 1rem;
            font-weight: bold;
        }
        .add-button:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            box-shadow: 0 0 5px rgba(64, 191, 193, 0.5);
        }
        .btn-action {
            padding: 7px 10px;
            margin: 2px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            display: inline-block;
        }
        .btn-warning {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            padding: 5px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-warning:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }
        .btn-edit {
            background-color: #40BFC1;
            color: #f1fafb;
        }
        .btn-edit:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Master Perlengkapan Ruang Rapat</h1>
        <a href="<?= base_url('/perlengkapan/create') ?>" class="add-button">Tambah Perlengkapan</a>

        <!-- Tampilkan Pesan Flash -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perlengkapan as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($item['nama_ruangan']) ?></td>
                        <td><?= esc($item['nama_barang']) ?></td>
                        <td><?= esc($item['jumlah']) ?></td>
                        <td>
                            <a href="<?= base_url('/perlengkapan/edit/' . $item['id']) ?>" class="btn-action btn-edit">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>
<?php echo view('footer.php');?>

</html>
