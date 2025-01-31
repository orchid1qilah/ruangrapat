<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Ruang Rapat</title>

    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
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
        .btn-edit {
            background-color: #40BFC1;
            color: #f1fafb;
        }
        .btn-edit:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .btn-delete {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .btn-delete:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }
        td[colspan] {
            font-style: italic;
            color: #666;
        }
    </style>

</head>
<body>
    <h1>Master Ruang Rapat</h1>
    <a href="<?= base_url('/ruangrapat/create') ?>" class="add-button">Input Ruang Rapat</a>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Layout Ruangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ruang_rapat)) : ?>
                <?php foreach ($ruang_rapat as $index => $ruang): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($ruang['nama_ruangan']) ?></td>
                        <td><?= esc($ruang['kapasitas']) ?></td>
                        <td><?= !empty($ruang['nama_layout']) ? esc($ruang['nama_layout']) : 'Tidak ada layout' ?></td>
                        <td>
                            <a href="<?= base_url('ruangrapat/edit/' . $ruang['id']) ?>" class="btn-action btn-edit">Edit</a>
                            <a href="<?= base_url('ruangrapat/delete/' . $ruang['id']) ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>                 
                    </tr>
                <?php endforeach; ?>
      

                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">Data Ruang Rapat tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
</body>
</html>
