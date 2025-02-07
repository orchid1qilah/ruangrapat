<!DOCTYPE html>
<html lang="en">
<head>
<?php echo view('header.php');?>
<br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layout</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f1fafb;
            color: #333;
        }
        .container {
            max-width: 600px;
            width: 90%;
            background-color: white;
            text-align:left;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #40BFC1;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            text-align: left;
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
            padding: 8px;
            border: 1px solid #40BFC1;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(64, 191, 193, 0.5);
            border-color: #40BFC1;
            outline: none;
        }

        .img-preview {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            border: 2px solid #40BFC1;
            padding: 5px;
            background-color: #f1fafb;
            margin: 10px auto;
        }

        .form-control-file {
            width: 100%;
            padding: 8px;
            border: 1px solid #40BFC1;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #fff;
            cursor: pointer;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-success {
            background-color: #40BFC1;
            border: none;
            color: white;
        }

        .btn-success:hover {
            background-color: #359a9c;
        }

        .btn-secondary {
            background-color: #f1fafb;
            border: 1px solid #40BFC1;
            color: #40BFC1;
        }

        .btn-secondary:hover {
            background-color: #40BFC1;
            color: white;
        }
    </style>
</head>
<body>
    <center>
    <h2>Edit Layout</h2>
    <div class="container">
        <form action="<?= base_url('inputlayout/update/' . $layout['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_layout">Nama Layout:</label>
                <input type="text" id="nama_layout" name="nama_layout" class="form-control" value="<?= esc($layout['nama_layout']) ?>" required>
            </div>

            <div class="form-group">
                <label>Gambar Saat Ini:</label>
                <img src="<?= base_url('uploads/' . $layout['image_path']) ?>" alt="Current Image" class="img-preview">
            </div>

            <div class="form-group">
                <label for="image_layout">Ganti Gambar:</label>
                <input type="file" id="image_layout" name="image_layout" class="form-control-file" accept=".jpeg,.png">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= base_url('inputlayout/list') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

<?php echo view('footer.php');?>
</html>
