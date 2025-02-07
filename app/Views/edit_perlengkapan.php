<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Perlengkapan</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            text-align:left;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #40BFC1;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #40BFC1;
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            border: 2px solid #40BFC1;
            border-radius: 5px;
            padding: 10px;
            font-size: 0.95rem;
            background-color: #f1fafb;
            outline: none;
        }
        .form-control:focus {
            border-color: #40BFC1;
            box-shadow: 0 0 8px rgba(64, 191, 193, 0.5);
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease-in-out;
            border: none;
        }
        .btn-success {
            background-color: #40BFC1;
            color: white;
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
        }
        .btn-secondary:hover {
            background-color: #40BFC1;
            color: white;
        }
    </style>
</head>
<body>
<center>
        <h2>Edit Perlengkapan</h2>
        <div class="container">
        <form action="<?= base_url('perlengkapan/update/' . $perlengkapan['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Nama Ruangan :</label>
                <select name="ruang_rapat_id" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    <?php foreach ($ruangan as $ruang) : ?>
                        <option value="<?= $ruang['id'] ?>" <?= $ruang['id'] == $perlengkapan['ruang_rapat_id'] ? 'selected' : '' ?>>
                            <?= esc($ruang['nama_ruangan']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nama Barang :</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= esc($perlengkapan['nama_barang']) ?>" required>
            </div>

            <div class="form-group">
                <label>Jumlah :</label>
                <input type="number" name="jumlah" class="form-control" value="<?= esc($perlengkapan['jumlah']) ?>" required>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('/perlengkapan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
<br><br><br>
<?php echo view('footer.php');?>
</html>
