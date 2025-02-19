<!DOCTYPE html>
<html lang="id">
<head>
    <?php echo view('header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Ruangan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Daftar Peminjaman Ruangan</h1>
    <table class="table table-bordered table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Ruang Rapat</th>
                <th>Kapasitas</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Acara</th>
                <th>Keterangan</th>
                <th>Konsumsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($peminjaman)) : ?>
                <?php $no = 1; foreach ($peminjaman as $item) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item['ruang_rapat_id']; ?></td>
                        <td><?= $item['kapasitas']; ?></td>
                        <td><?= $item['tanggal_peminjaman']; ?></td>
                        <td><?= $item['waktu_mulai']; ?> - <?= $item['waktu_selesai']; ?></td>
                        <td><?= ucfirst($item['acara']); ?></td>
                        <td><?= $item['keterangan_acara']; ?></td>
                        <td><?= $item['konsumsi']; ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="9" class="text-center">Belum ada data peminjaman.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="<?= base_url('/peminjaman/create'); ?>" class="btn btn-primary">Tambah Peminjaman</a>
</div>

</body>
<?php echo view('footer.php'); ?>
</html>
