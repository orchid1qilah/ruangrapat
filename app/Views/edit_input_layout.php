<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1fafb;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #40BFC1;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group label {
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
        .img-preview {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            border: 2px solid #40BFC1;
            padding: 5px;
            background-color: #f1fafb;
        }
        .btn-success {
            background-color: #40BFC1;
            border: none;
            color: #f1fafb;
            font-weight: bold;
            width: 100%;
        }
        .btn-success:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .btn-secondary {
            background-color: #f1fafb;
            border: 1px solid #40BFC1;
            color: #40BFC1;
            font-weight: bold;
            width: 100%;
        }
        .btn-secondary:hover {
            background-color: #40BFC1;
            color: #f1fafb;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Layout</h3>
        <form action="<?= base_url('inputlayout/update/' . $layout['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Layout:</label>
                <input type="text" name="nama_layout" class="form-control" value="<?= esc($layout['nama_layout']) ?>" required>
            </div>
            <div class="form-group text-center">
                <label>Gambar Saat Ini:</label><br>
                <img src="<?= base_url('uploads/' . $layout['image_path']) ?>" alt="Current Image" class="img-preview" width="150">
            </div>
            <div class="form-group">
                <label>Ganti Gambar:</label>
                <input type="file" name="image_layout" class="form-control-file" accept=".jpeg,.png">
            </div>
            <button type="submit" class="btn btn-success mt-3">Update</button>
            <a href="<?= base_url('inputlayout/list') ?>" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</body>
</html>
