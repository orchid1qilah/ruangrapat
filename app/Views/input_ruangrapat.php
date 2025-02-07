<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruang Rapat</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            text-align:left;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #40BFC1;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            padding: 10px;
            border: 1px solid #40BFC1;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f1fafb;
            outline: none;
        }
        .form-control:focus {
            border-color: #40BFC1;
            box-shadow: 0 0 8px rgba(64, 191, 193, 0.5);
        }
        .layout-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #40BFC1;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f1fafb;
            outline: none;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease-in-out;
            border: none;
        }
        .btn-primary {
            background-color: #40BFC1;
            color: white;
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
        }
        .btn-secondary:hover {
            background-color: #40BFC1;
            color: white;
        }
        .btn-warning {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
            padding: 5px 10px;
            font-size: 0.9rem;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-warning:hover {
            background-color: #40BFC1;
            color: white;
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
    <center>
        <h2>Tambah Ruang Rapat</h2>
        <div class="container">
        <form id="ruangRapatForm" action="<?= base_url('ruangrapat/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Nama Ruangan :</label>
                <input type="text" name="nama_ruangan" class="form-control" placeholder="Masukkan Nama Ruangan" required>
            </div>
            
            <div class="form-group">
                <label>Kapasitas :</label>
                <input type="number" name="kapasitas" class="form-control" placeholder="Masukkan Kapasitas Ruangan" required>
            </div>

            <div id="layoutContainer">
                <div class="form-group layout-group" id="layout_group_1">
                    <label>Layout Ruangan :</label>
                    <div style="display: flex; gap: 10px;">
                        <select id="layout_id_1" name="layout_id[]" class="layout-select" onchange="loadgambar(this);" required>
                            <option value="">Pilih Layout</option>
                            <?php foreach ($layouts as $layout) : ?>
                                <option value="<?= $layout['id'] ?>"><?= esc($layout['nama_layout']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-warning" onclick="removeLayout(1)">Batal</button>
                    </div>
                    <div class="form-group">
                        <img id="imglayout_1" src="<?= base_url('img/noimage.jpg') ?>" style="width: 200px;">
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button type="button" class="btn btn-primary" id="btnTambah">Tambah Layout Baru</button>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('/ruangrapat/list') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        let layoutIndex = 1;

        // Tambah Layout Baru
        document.getElementById('btnTambah').addEventListener('click', function () {
            layoutIndex++;
            const layoutGroup = document.createElement('div');
            layoutGroup.classList.add('form-group', 'layout-group');
            layoutGroup.id = `layout_group_${layoutIndex}`;
            layoutGroup.innerHTML = `
                <label>Layout Ruangan:</label>
                <div style="display: flex; gap: 10px;">
                    <select id="layout_id_${layoutIndex}" name="layout_id[]" class="layout-select" onchange="loadgambar(this);" required>
                        <option value="">Pilih Layout</option>
                        <?php foreach ($layouts as $layout): ?>
                            <option value="<?= $layout['id'] ?>"><?= esc($layout['nama_layout']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-warning" onclick="removeLayout(${layoutIndex})">Batal</button>
                </div>
                <div class="form-group">
                    <img id="imglayout_${layoutIndex}" src="<?= base_url('img/noimage.jpg') ?>" style="width: 200px;">
                </div>
            `;
            document.getElementById('layoutContainer').appendChild(layoutGroup);
        });

        // Load gambar berdasarkan layout yang dipilih
        function loadgambar(selectElement) {
            const layoutId = selectElement.value;
            const layoutIndex = selectElement.id.split('_')[2];
            fetch(`<?= base_url('ruangrapat/show') ?>/${layoutId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById(`imglayout_${layoutIndex}`).src = data.path;
                })
                .catch(error => alert("Error json: " + error));
        }

        // Hapus Layout
        function removeLayout(index) {
            const layoutCount = document.querySelectorAll('.layout-group').length;
            if (layoutCount > 1) {
                document.getElementById(`layout_group_${index}`).remove();
            } else {
                alert('Minimal satu layout harus dipilih.');
            }
        }
    </script>
</body>
<?php echo view('footer.php');?>

</html>
