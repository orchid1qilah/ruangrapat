<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #f1fafb;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        h1 {
            color: #40BFC1;
            text-align: center;
            font-weight: bold;
        }

        label {
            font-weight: 600;
            color: #40BFC1;
        }

        .form-control {
            border: 2px solid #40BFC1;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #40BFC1;
            border: none;
        }

        .btn-primary:hover {
            background-color: #359a9c;
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        .icon-title {
            margin-right: 8px;
            color: #40BFC1;
        }

        textarea {
            resize: none;
        }

        .checkbox-group label {
            margin-right: 10px;
        }

        .image-preview img {
            max-width: 150px;
            max-height: 100px;
            margin: 5px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Form Peminjaman Ruang Rapat</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/peminjaman/store') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="ruang_rapat_id"><i class="fas fa-door-open"></i> Pilih Ruangan:</label>
            <select name="ruang_rapat_id" id="ruang_rapat_id" class="form-control" required>
                <option value="">Pilih Ruangan</option>
                <?php foreach ($ruangan as $ruang): ?>
                    <option value="<?= $ruang['id'] ?>" 
                            data-kapasitas="<?= $ruang['kapasitas'] ?>" 
                            data-layouts='<?= json_encode($ruang['layouts']) ?>'>
                        <?= $ruang['nama_ruangan'] ?> - Kapasitas: <?= $ruang['kapasitas'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="kapasitas"><i class="fas fa-users"></i> Kapasitas Ruangan:</label>
            <input type="text" id="kapasitas" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label><i class="fas fa-th-large"></i> Pilihan Layout:</label>
            <div class="image-preview border p-3" id="layout-options">
                <p class="text-muted">Silakan pilih ruangan terlebih dahulu.</p>
            </div>
        </div>

        <div class="form-group">
            <label for="acara"><i class="fas fa-calendar-check"></i> Acara:</label>
            <select name="acara" id="acara" class="form-control" required>
                <option value="internal">Acara Internal</option>
                <option value="eksternal">Acara Eksternal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan_acara"><i class="fas fa-pencil-alt"></i> Keterangan Acara:</label>
            <textarea name="keterangan_acara" id="keterangan_acara" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label><i class="fas fa-utensils"></i> Konsumsi:</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="konsumsi[]" value="air"> Air</label>
                <label><input type="checkbox" name="konsumsi[]" value="teh"> Teh</label>
                <label><input type="checkbox" name="konsumsi[]" value="kopi"> Kopi</label>
                <label><input type="checkbox" name="konsumsi[]" value="gula"> Gula</label>
                <label><input type="checkbox" name="konsumsi[]" value="creamer"> Creamer</label>
                <label><input type="checkbox" name="konsumsi[]" value="kue"> Kue</label>
                <label><input type="checkbox" name="konsumsi[]" value="lunch"> Lunch</label>
            </div>
            <textarea name="konsumsi_lain" id="konsumsi_lain" class="form-control mt-2" placeholder="Tulis konsumsi tambahan (opsional)"></textarea>
        </div>

        <div class="form-group">
            <label for="tanggal_peminjaman"><i class="fas fa-calendar"></i> Tanggal Peminjaman:</label>
            <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu_mulai"><i class="fas fa-clock"></i> Waktu Mulai:</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu_selesai"><i class="fas fa-clock"></i> Waktu Selesai:</label>
            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </form>
</div>

<script>
    document.querySelector('#ruang_rapat_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const kapasitas = selectedOption.getAttribute('data-kapasitas');
        document.querySelector('#kapasitas').value = kapasitas;

        const layoutOptions = document.querySelector('#layout-options');
        layoutOptions.innerHTML = ''; 

        const layouts = JSON.parse(selectedOption.getAttribute('data-layouts'));
        if (layouts.length > 0) {
            layouts.forEach(layout => {
                layoutOptions.innerHTML += `
                    <label class="mr-3">
                        <input type="radio" name="layout_id" value="${layout.id}" required>
                        <img src="<?= base_url('uploads/') ?>${layout.image_path}" alt="${layout.nama_layout}" class="img-thumbnail">
                        <br>${layout.nama_layout}
                    </label>
                `;
            });
        } else {
            layoutOptions.innerHTML = '<p class="text-muted">Tidak ada layout tersedia untuk ruangan ini.</p>';
        }
    });
</script>
</body>
</html>
