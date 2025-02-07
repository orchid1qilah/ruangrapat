<!DOCTYPE html>
<html lang="id">
<head>
<?php echo view('header.php');?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Ruangan</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Daftar Peminjaman Ruangan</h2>
    <a href="<?= base_url('/peminjaman/create') ?>" class="btn btn-primary mb-3">Tambah Peminjaman</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Ruang Rapat</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Acara</th>
                <th>Konsumsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($peminjaman)): ?>
                <?php foreach ($peminjaman as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($row['nama_ruangan']) ?></td>
                        <td><?= esc($row['tanggal_peminjaman']) ?></td>
                        <td><?= esc($row['waktu_mulai']) ?> - <?= esc($row['waktu_selesai']) ?></td>
                        <td><?= esc($row['keterangan_acara']) ?></td>
                        <td><?= esc($row['konsumsi']) ?></td>
                        <td>
                            <a href="<?= base_url('/peminjaman/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('/peminjaman/delete/' . $row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada data peminjaman</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
