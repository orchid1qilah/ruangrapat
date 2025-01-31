<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman Ruang Rapat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #f1fafb;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #40BFC1;
            text-align: center;
            font-weight: bold;
        }

        .table th {
            background-color: #40BFC1;
            color: white;
        }

        .btn-primary {
            background-color: #40BFC1;
            border: none;
        }

        .btn-primary:hover {
            background-color: #359a9c;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Peminjaman Ruang Rapat</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Acara</th>
                <th>Konsumsi</th>
                <th>Layout</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($peminjaman)): ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data peminjaman.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($peminjaman as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($item['nama_ruangan']) ?></td>
                        <td><?= esc($item['kapasitas']) ?></td>
                        <td><?= esc($item['tanggal_peminjaman']) ?></td>
                        <td><?= esc($item['waktu_mulai']) ?> - <?= esc($item['waktu_selesai']) ?></td>
                        <td><?= esc($item['acara']) ?> - <?= esc($item['keterangan_acara']) ?></td>
                        <td><?= esc($item['konsumsi']) ?: '-' ?></td>
                        <td><?= esc($item['nama_layout']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= base_url('/peminjaman/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Peminjaman</a>
</div>
</body>
</html>
