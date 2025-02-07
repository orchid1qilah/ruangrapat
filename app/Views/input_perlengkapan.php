<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <title>Tambah Perlengkapan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            text-align:left;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
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
            border: 2px solid #40BFC1;
            border-radius: 5px;
            padding: 8px;
            font-size: 0.95rem;
            background-color: #f1fafb;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #40BFC1;
            box-shadow: 0 0 5px rgba(64, 191, 193, 0.5);
            outline: none;
        }

        .btn {
            padding: 8px 15px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background-color: #40BFC1;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }

        .btn-warning {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            font-size: 0.9rem;
        }

        .btn-warning:hover {
            background-color: #40BFC1;
            color: #fff;
        }

        .btn-success {
            background-color: #40BFC1;
            color: #fff;
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
            color: #fff;
        }

        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        .barang-group {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #40BFC1;
        }

        .barang-group label {
            font-size: 14px;
        }

        .barang-group input {
            font-size: 14px;
            width: 100%;
            padding: 5px;
            margin-bottom: 5px;
        }

        .barang-group button {
            margin-top: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
<center>
    <h2>Tambah Perlengkapan</h2>
    <div class="container">
        <form id="perlengkapanForm" action="<?= base_url('perlengkapan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Nama Ruangan :</label>
                <select name="ruang_rapat_id" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    <?php foreach ($ruangan as $ruang) : ?>
                        <option value="<?= $ruang['id'] ?>"><?= esc($ruang['nama_ruangan']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="barangContainer">
                <div class="form-group barang-group" id="barang_group_1">
                    <label>Nama Barang :</label>
                    <input type="text" name="nama_barang[]" class="form-control" required>

                    <label>Jumlah :</label>
                    <input type="number" name="jumlah[]" class="form-control" required>

                    <button type="button" class="btn btn-warning" onclick="removeBarang(1)">Hapus</button>
                </div>
            </div>

            <button type="button" class="btn btn-primary" id="btnTambahBarang">Tambah Barang</button>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('/perlengkapan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        let barangIndex = 1;

        document.getElementById('btnTambahBarang').addEventListener('click', function () {
            barangIndex++;
            const barangGroup = document.createElement('div');
            barangGroup.classList.add('form-group', 'barang-group');
            barangGroup.id = `barang_group_${barangIndex}`;
            barangGroup.innerHTML = `
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang[]" class="form-control" required>

                <label>Jumlah:</label>
                <input type="number" name="jumlah[]" class="form-control" required>

                <button type="button" class="btn btn-warning" onclick="removeBarang(${barangIndex})">Hapus</button>
            `;
            document.getElementById('barangContainer').appendChild(barangGroup);
        });

        function removeBarang(index) {
            const barangCount = document.querySelectorAll('.barang-group').length;
            if (barangCount > 1) {
                document.getElementById(`barang_group_${index}`).remove();
            } else {
                alert('Minimal satu barang harus diinput.');
            }
        }
    </script>

</body>
<?php echo view('footer.php');?>

</html>
