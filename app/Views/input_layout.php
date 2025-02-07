<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Layout Ruang Rapat</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f1fafb;
            color: #333;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            text-align:left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        h2 {
            color: #40BFC1;
            font-weight: bold;
            text-align: center;
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: bold;
            color: #40BFC1;
            display: block;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #40BFC1;
            border-radius: 5px;
            margin-bottom: 16px;
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
            margin-bottom: 16px;
        }

        .file-input:hover {
            background-color: #e7f9f9;
        }

        .btn-primary, .btn-secondary {
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: #40BFC1;
            color: #f1fafb;
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
        }

        .btn-secondary:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            h3 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <center>
    <h2>Input Layout Ruang Rapat</h2>

    <div class="form-container">
        <form action="<?= base_url('inputlayoutcontroller/upload') ?>" method="post" enctype="multipart/form-data">
            <div id="dynamicInputContainer">
                <div class="row">
                    <label class="form-label">Nama Layout :</label>
                    <input type="text" name="nama_layout[]" class="form-control" placeholder="Masukkan nama layout" required>
                    
                    <label class="form-label">Image Layout :</label>
                    <div class="file-input">
                        <input type="file" name="image_layout[]" class="form-control-file" accept=".jpeg,.png" required>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-primary" id="btnTambah">Tambah Layout Baru</button>
            </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary">Batal</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('btnTambah').addEventListener('click', function () {
            let container = document.getElementById('dynamicInputContainer');
            let newInput = `
                <div class="row">
                    <label class="form-label">Nama Layout:</label>
                    <input type="text" name="nama_layout[]" class="form-control" placeholder="Masukkan nama layout" required>
                    
                    <label class="form-label">Image Layout:</label>
                    <div class="file-input">
                        <input type="file" name="image_layout[]" class="form-control-file" accept=".jpeg,.png" required>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newInput);
        });
    </script>
</body>
<br><br><br><br>
<?php echo view('footer.php');?>

</html>
