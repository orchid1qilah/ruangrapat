<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Perlengkapan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #40BFC1;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: bold;
            color: #40BFC1;
        }
        .form-control {
            border: 2px solid #40BFC1;
            border-radius: 5px;
            padding: 10px;
            font-size: 0.95rem;
            background-color: #f1fafb;
        }
        .form-control:focus {
            border-color: #40BFC1;
            box-shadow: 0 0 8px rgba(64, 191, 193, 0.5);
        }
        .btn-success {
            background-color: #40BFC1;
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }
        .btn-success:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .btn-secondary {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }
        .btn-secondary:hover {
            background-color: #40BFC1;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Perlengkapan</h3>
        <form action="<?= base_url('perlengkapan/update/' . $perlengkapan['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Nama Ruangan:</label>
                <select name="ruang_rapat_id" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    <?php foreach ($ruangan as $ruang): ?>
                        <option value="<?= $ruang['id'] ?>" <?= $ruang['id'] == $perlengkapan['ruang_rapat_id'] ? 'selected' : '' ?>>
                            <?= esc($ruang['nama_ruangan']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= esc($perlengkapan['nama_barang']) ?>" required>
            </div>

            <div class="form-group">
                <label>Jumlah:</label>
                <input type="number" name="jumlah" class="form-control" value="<?= esc($perlengkapan['jumlah']) ?>" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('/perlengkapan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
