<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Perlengkapan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            width: 100%;
            height:20%;
        }

        .form-control:focus {
            border-color: #40BFC1;
            box-shadow: 0 0 8px rgba(64, 191, 193, 0.5);
        }

        .btn-primary {
            background-color: #40BFC1;
            border: none;
            padding: 7px 12px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
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
            padding: 5px 15px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .btn-warning:hover {
            background-color: #40BFC1;
            border: 1px solid #fff;
            color: #fff;
        }

        .btn-success {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            padding: 5px 15px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .btn-success:hover {
            background-color: #40BFC1;
            color: #fff;
            border: 1px solid #fff;
        }

        .btn-secondary {
            background-color: #40BFC1;
            border: none;
            padding: 5px 15px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .btn-secondary:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }

        .text-center {
            margin-top: 30px;
        }

        .barang-group {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .barang-group label {
            font-size: 14px;
        }

        .barang-group input {
            font-size: 14px;
            width: 100%;
        }

        .barang-group button {
            margin-top: 10px;
        }
        

    </style>
</head>
<body>
    <div class="container mt-5">
        <h3>Tambah Perlengkapan</h3>
        <form id="perlengkapanForm" action="<?= base_url('perlengkapan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Nama Ruangan:</label>
                <select name="ruang_rapat_id" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    <?php foreach ($ruangan as $ruang): ?>
                        <option value="<?= $ruang['id'] ?>"><?= esc($ruang['nama_ruangan']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="barangContainer">
                <div class="form-group barang-group" id="barang_group_1">
                    <label>Nama Barang:</label>
                    <input type="text" name="nama_barang[]" class="form-control" required>

                    <label>Jumlah:</label>
                    <input type="number" name="jumlah[]" class="form-control" required>

                    <button type="button" class="btn btn-warning btn-sm mt-2" onclick="removeBarang(${barangIndex})">Hapus</button>
                </div>
            </div>

            <button type="button" class="btn btn-primary mt-3" id="btnTambahBarang">
                <i class="fas fa-plus"></i> Tambah Barang
            </button>

            <div class="text -center mt-4">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('/perlengkapan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        let barangIndex = 1;

        $('#btnTambahBarang').on('click', function () {
            barangIndex++;
            const barangGroup = `
                <div class="form-group barang-group" id="barang_group_${barangIndex}">
                    <label>Nama Barang:</label>
                    <input type="text" name="nama_barang[]" class="form-control" required>

                    <label>Jumlah:</label>
                    <input type="number" name="jumlah[]" class="form-control" required>

                    <button type="button" class="btn btn-warning btn-sm mt-2" onclick="removeBarang(${barangIndex})">Hapus</button>
                </div>`;
            $('#barangContainer').append(barangGroup);
        });

        function removeBarang(index) {
            const barangCount = $('.barang-group').length;
            if (barangCount > 1) {
                $(`#barang_group_${index}`).remove();
            } else {
                alert('Minimal satu barang harus diinput.');
            }
        }
    </script>
</body>
</html>
