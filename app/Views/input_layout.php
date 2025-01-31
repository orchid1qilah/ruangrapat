<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Layout Ruang Rapat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1fafb;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #40BFC1;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
            color: #40BFC1;
        }
        .form-control {
            border: 1px solid #40BFC1;
            border-radius: 5px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(64, 191, 193, 0.5);
            border-color: #40BFC1;
        }
        .file-input {
            border: 2px dashed #40BFC1;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            background-color: #f1fafb;
        }
        .file-input:hover {
            background-color: #e7f9f9;
        }
        .btn-primary {
            background-color: #40BFC1;
            border: none;
            color: #f1fafb;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .btn-secondary {
            background-color: #f1fafb;
            border: 1px solid #40BFC1;
            color: #40BFC1;
            font-weight: bold;
        }
        .btn-secondary:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h3 class="text-center mb-4">Input Layout Ruang Rapat</h3>
            <form action="<?= base_url('inputlayoutcontroller/upload') ?>" method="post" enctype="multipart/form-data">
                <div id="dynamicInputContainer">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Layout:</label>
                            <input type="text" name="nama_layout[]" class="form-control" placeholder="Masukkan nama layout" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image Layout:</label>
                            <div class="file-input">
                                <input type="file" name="image_layout[]" class="form-control-file" accept=".jpeg,.png" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mb-3">
                    <button type="button" class="btn btn-primary" id="btnTambah">Tambah Layout Baru</button>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('btnTambah').addEventListener('click', function () {
            let container = document.getElementById('dynamicInputContainer');
            let newInput = `
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Layout:</label>
                        <input type="text" name="nama_layout[]" class="form-control" placeholder="Masukkan nama layout" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image Layout:</label>
                        <div class="file-input">
                            <input type="file" name="image_layout[]" class="form-control-file" accept=".jpeg,.png" required>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newInput);
        });
    </script>
</body>
</html>
