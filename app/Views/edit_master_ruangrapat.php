<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruang Rapat</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }
        .container {
            max-width: 600px;
            width: 90%;
            background: #fff;
            padding: 20px;
            text-align:left;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #40BFC1;
            font-weight: bold;
            text-align: center;
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

        .form-control,
        .layout-select {
            width: 100%;
            padding: 8px;
            border: 1px solid #40BFC1;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-control:focus,
        .layout-select:focus {
            outline: none;
            border-color: #359a9c;
            box-shadow: 0 0 5px rgba(64, 191, 193, 0.5);
        }

        .layout-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background-color: #40BFC1;
            color: white;
        }

        .btn-primary:hover {
            background-color: #359a9c;
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
        }

        .btn-warning:hover {
            background-color: #40BFC1;
            color: white;
        }

        .img-preview {
            width: 100%;
            max-width: 200px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <center>
<h2>Edit Ruang Rapat</h2>
    <div class="container">
        <form id="ruangRapatForm" action="<?= base_url('ruangrapat/update/' . $ruangRapat['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="nama_ruangan">Nama Ruangan:</label>
                <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control" value="<?= esc($ruangRapat['nama_ruangan']) ?>" required>
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="number" id="kapasitas" name="kapasitas" class="form-control" value="<?= esc($ruangRapat['kapasitas']) ?>" required>
            </div>

            <div id="layoutContainer">
                <?php foreach ($selectedLayoutIds as $index => $layoutId): ?>
                    <div class="form-group layout-group" id="layout_group_<?= $index + 1 ?>">
                        <label>Layout Ruangan:</label>
                        <select id="layout_id_<?= $index + 1 ?>" name="layout_id[]" class="layout-select" required>
                            <option value="">Pilih Layout</option>
                            <?php foreach ($layouts as $layout): ?>
                                <option value="<?= $layout['id'] ?>" <?= $layout['id'] == $layoutId ? 'selected' : '' ?>>
                                    <?= esc($layout['nama_layout']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-warning" onclick="removeLayout(<?= $index + 1 ?>)">Batal</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-primary" id="btnTambah">Tambah Layout Baru</button>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('/ruangrapat/list') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        let layoutIndex = <?= count($selectedLayoutIds) ?>;

        // Tambah Layout Baru
        document.getElementById('btnTambah').addEventListener('click', function () {
            layoutIndex++;
            const layoutGroup = document.createElement('div');
            layoutGroup.classList.add('form-group', 'layout-group');
            layoutGroup.id = `layout_group_${layoutIndex}`;
            layoutGroup.innerHTML = `
                <label>Layout Ruangan:</label>
                <select id="layout_id_${layoutIndex}" name="layout_id[]" class="layout-select" required>
                    <option value="">Pilih Layout</option>
                    <?php foreach ($layouts as $layout): ?>
                        <option value="<?= $layout['id'] ?>"><?= esc($layout['nama_layout']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="btn btn-warning" onclick="removeLayout(${layoutIndex})">Batal</button>
            `;
            document.getElementById('layoutContainer').appendChild(layoutGroup);
        });

        // Hapus Layout
        function removeLayout(index) {
            const layoutCount = document.querySelectorAll('.layout-group').length;
            if (layoutCount > 1) {
                document.getElementById(`layout_group_${index}`).remove();
            } else {
                alert('Minimal satu layout harus dipilih.');
            }
        }

        // Validasi Form
        document.getElementById('ruangRapatForm').addEventListener('submit', function (event) {
            const layoutCount = document.querySelectorAll('.layout-group').length;
            if (layoutCount < 1) {
                alert('Minimal satu layout harus dipilih.');
                event.preventDefault();
            }
        });
    </script>
</body>

<?php echo view('footer.php');?>
</html>
