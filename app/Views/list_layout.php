<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Layout Ruang Rapat</title>
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
            border-bottom: 1px solid #ddd;
            font-size: 0.95rem;
        }
        table tbody tr:hover {
            background-color: #f1fafb;
        }
        .image-preview {
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
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
    <h1>Master Layout Ruang Rapat</h1>
    <a href="<?= base_url('/inputlayout') ?>" class="add-button">Input Data</a>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Layout</th>
                <th>Image</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($layouts)) : ?>
                <?php foreach ($layouts as $index => $layout) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($layout['nama_layout']) ?></td>
                        <td>
                            <img src="<?= base_url('uploads/' . $layout['image_path']) ?>" 
                                 alt="Layout Image" 
                                 class="image-preview">
                        </td>
                        <td>
                            <a href="<?= base_url('inputlayout/edit/' . $layout['id']) ?>" 
                              class="btn-action btn-edit">Edit</a>
                            <a href="<?= base_url('inputlayout/delete/' . $layout['id']) ?>" 
                              class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak menemukan data layout</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
<?php echo view('footer.php');?>
</html>
