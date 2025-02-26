<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman Ruang Rapat</title>
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
        table {
            width: 90%;
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
            font-size: 0.95rem;
            border-bottom: 1px solid #ddd;
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
            padding: 7px 12px;
            margin: 2px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <br>
        <h1>Data Peminjaman Ruang Rapat</h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <a href="<?= base_url('/peminjaman/create') ?>" class="add-button"> Tambah Peminjaman </a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Jumlah Peserta</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Acara</th>
                    <th>Konsumsi</th>
                    <th>Layout</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
    <?php if (empty($peminjaman)): ?>
        <tr>
            <td colspan="8" style="text-align: center;">Tidak ada data peminjaman.</td>
        </tr>
    <?php else: ?>
        <?php $no = 1; foreach ($peminjaman as $item): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($item['nama_ruangan']) ?></td>
                <td><?= esc($item['jumlah_peserta']) ?></td> 
                <td><?= esc($item['tanggal_peminjaman']) ?></td>
                <td><?= esc($item['waktu_mulai']) ?> - <?= esc($item['waktu_selesai']) ?></td>
                <td><?= esc($item['acara']) ?> - <?= esc($item['keterangan_acara']) ?></td>
                <td><?= esc($item['konsumsi']) ?: '-' ?></td>
                <td><?= esc($item['nama_layout']) ?></td>
                <td><?= esc($item['status']) ?></td>

            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>

            </tbody>
        </table>

    </div>
</body>
</html>
