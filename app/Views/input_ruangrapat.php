<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruang Rapat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #40BFC1;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-control {
            border: 1px solid #40BFC1;
            border-radius: 5px;
        }
        .form-group label {
            font-weight: bold;
            color: #40BFC1;
        }
        .btn-primary {
            background-color: #40BFC1;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .btn-secondary {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }
        .btn-secondary:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }
        .btn-warning {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            padding: 5px 10px;
            font-size: 0.9rem;
            border-radius: 5px;
        }
        .btn-warning:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }
        .layout-select {
            border: 1px solid #40BFC1;
            border-radius: 5px;
        }
        img {
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Tambah Ruang Rapat</h3>
        <form id="ruangRapatForm" action="<?= base_url('ruangrapat/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <div class="form-group">
                <label>Nama Ruangan:</label>
                <input type="text" name="nama_ruangan" class="form-control" placeholder="Masukkan Nama Ruangan" required>
            </div>
            
            <div class="form-group">
                <label>Kapasitas:</label>
                <input type="number" name="kapasitas" class="form-control" placeholder="Masukkan Kapasitas Ruangan" required>
            </div>

            <div id="layoutContainer">
                <div class="form-group layout-group" id="layout_group_1">
                    <label>Layout Ruangan:</label>
                    <div class="d-flex">
                        <select id="layout_id_1" name="layout_id[]" class="form-control layout-select" onchange="loadgambar(this);" required>
                            <option value="">Pilih Layout</option>
                            <?php foreach ($layouts as $layout): ?>
                                <option value="<?= $layout['id'] ?>"><?= esc($layout['nama_layout']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-warning btn-sm ml-2" onclick="removeLayout(1)">Batal</button>
                    </div>
                    <div class="form-group mt-2">
                        <img id="imglayout_1" src="<?= base_url('img/noimage.jpg') ?>" style="width: 200px;">
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-primary" id="btnTambah">Tambah Layout Baru</button>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('/ruangrapat/list') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        let layoutIndex = 1;

        // Tambah Layout Baru
        $('#btnTambah').on('click', function () {
            layoutIndex++;
            const layoutGroup = `
                <div class="form-group layout-group" id="layout_group_${layoutIndex}">
                    <label>Layout Ruangan:</label>
                    <div class="d-flex">
                        <select id="layout_id_${layoutIndex}" name="layout_id[]" class="form-control layout-select" onchange="loadgambar(this);" required>
                            <option value="">Pilih Layout</option>
                            <?php foreach ($layouts as $layout): ?>
                                <option value="<?= $layout['id'] ?>"><?= esc($layout['nama_layout']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-warning btn-sm ml-2" onclick="removeLayout(${layoutIndex})">Batal</button>
                    </div>
                    <div class="form-group mt-2">
                        <img id="imglayout_${layoutIndex}" src="<?= base_url('img/noimage.jpg') ?>" style="width: 200px;">
                    </div>
                </div>`;
            $('#layoutContainer').append(layoutGroup);
        });

        // Load gambar berdasarkan layout yang dipilih
        function loadgambar(selectElement) {
            const layoutId = selectElement.value;
            const layoutIndex = selectElement.id.split('_')[2];
            $.ajax({
                url: "<?= base_url('ruangrapat/show') ?>/" + layoutId,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $(`#imglayout_${layoutIndex}`).attr('src', data.path);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error json: " + errorThrown);
                }
            });
        }

        // Hapus Layout
        function removeLayout(index) {
            const layoutCount = $('.layout-group').length;
            if (layoutCount > 1) {
                $(`#layout_group_${index}`).remove();
            } else {
                alert('Minimal satu layout harus dipilih.');
            }
        }

        // Validasi Form
        $('#ruangRapatForm').on('submit', function () {
            const layoutCount = $('.layout-group').length;
            if (layoutCount < 1) {
                alert('Minimal satu layout harus dipilih.');
                return false;
            }
        });
    </script>
</body>
</html>
