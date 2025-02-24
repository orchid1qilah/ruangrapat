<!DOCTYPE html>
<html lang="id">
<head>
<?php echo view('header.php');?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peraturan Peminjaman Ruangan & Form Peminjaman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8F8;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 70%;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h1 {
            color: #40BFC1;
            text-align: center;
            font-weight: bold;
        }

        .title {
            text-align: center;
            background-color: #40BFC1;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.5em;
            font-weight: bold;
        }

        label {
            font-weight: 600;
            color: #40BFC1;
        }

        .form-control, .btn-primary {
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

        .box-container {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .box {
            background-color: #EAF7F1;
            padding: 15px;
            border-radius: 5px;
            border-left: 5px solid #40BFC1;
            width: 48%;
            box-sizing: border-box;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 5px;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group label {
            flex: 1;
            max-width: 200px;
        }

        .form-group .form-control {
            flex: 2;
            max-width: 350px;
        }

        .form-group .form-control1 {
            flex: 2;
            width: 350px;
        }
        .form-group textarea {
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

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
<br>
    <div class="container">
        <h1 class="title">Peraturan Peminjaman Ruangan</h1>
        <div class="box-container">
            <div class="box">
                <p>Sebelum mengisi form peminjaman lebih dahulu melihat jadwal ruang rapat untuk mengetahui ruang rapat yang tersedia dan Khusus untuk ruang rapat berikut:</p>
                <ul>
                    <li>Ruang Rapat Jungle & Forest ijin terlebih dahulu ke Sdr. Lia, ext 2601</li>
                    <li>Ruang Rapat Competen & Competitive ijin terlebih dahulu ke Sdr. Irsa ext. 2421</li>
                    <li>Ruang Rapat Lt.2 Unit3 (Eksekutif) ijin terlebih dahulu ke Sdr. Rini ext. 2401</li>
                    <li>Ruang Rapat Press / Cyan ijin terlebih dahulu pihak PRESS</li>
                </ul>
                <p>Setelah ruang rapat bisa dipinjam, silakan Pemakai mengisi formulir peminjaman ruang rapat yang terdapat di intranet (minimal 2 hari sebelum pelaksanaan), bila peminjamannya mendadak atau 1 hari sebelumnya mohon bantuan untuk memberitahu General Affairs.</p>
            </div>
            <div class="box">
                <p><strong>Saat pengisian tidak lupa mencantumkan:</strong></p>
                <ul>
                    <li>Division / Departement</li>
                    <li>Tanggal / hari rapat</li>
                    <li>Jumlah peserta rapat</li>
                    <li>Nama acara</li>
                    <li>Layout meja yang diinginkan</li>
                    <li>Peralatan rapat yang dibutuhkan</li>
                </ul>
                <p>Bila ada pembatalan pemakaian ruang rapat harap segera diinformasikan ke General Affairs ext. 2501, sehingga ruangan dapat dipakai oleh yang lain.</p>
            </div>
        </div>
        <br>
        <h1 class="title">Form Peminjaman Ruang Rapat</h1>

        <form action="<?= base_url('/peminjaman/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="tanggal_peminjaman"><i class="fas fa-calendar"></i>Tanggal Peminjaman :</label>
                <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" required>
            </div>

            <div class="form-group">
    <label for="ruang_rapat_id"><i class="fas fa-door-open"></i> Pilih Ruangan :</label>
    <select name="ruang_rapat_id" id="ruang_rapat_id" class="form-control" required>
        <option value="">Pilih Ruangan</option>
        <?php foreach ($ruangan as $ruang): ?>
            <option value="<?= $ruang['id'] ?>" 
                    data-kapasitas="<?= $ruang['kapasitas'] ?>" 
                    data-layouts='<?= json_encode($ruang['layouts']) ?>'>
                <?= $ruang['nama_ruangan'] ?> - Kapasitas : <?= $ruang['kapasitas'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="kapasitas"><i class="fas fa-users"></i> Kapasitas Maksimal :</label>
    <input type="text" id="kapasitas" name="kapasitas" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="jumlah_peserta"><i class="fas fa-user-plus"></i> Jumlah Peserta :</label>
    <input type="number" id="jumlah_peserta" name="jumlah_peserta" class="form-control" min="1" required>
    <small id="kapasitas-error" class="text-danger" style="display:none;">Jumlah peserta melebihi kapasitas maksimal!</small>
</div>


            <div class="form-group">
                <label><i class="fas fa-th-large"></i> Pilihan Layout :</label>
                <div class="image-preview border p-3" id="layout-options">
                    <p class="text-muted">Silakan pilih ruangan terlebih dahulu.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="waktu_mulai"><i class="fas fa-clock"></i> Waktu Mulai - Selesai :</label>
                <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control"required>
                
                <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="acara"><i class="fas fa-calendar-check"></i> Acara :</label>
                <select name="acara" id="acara" class="form-control" required>
                    <option value="internal">Acara Internal</option>
                    <option value="eksternal">Acara Eksternal</option>
                </select>

                <textarea name="keterangan_acara" id="keterangan_acara" class="form-control"  placeholder="Keterangan Acara" required ></textarea>

            </div>

            <div class="form-group">
                <label><i class="fas fa-utensils"></i> Konsumsi :</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="konsumsi[]" value="air"> Air</label>
                    <label><input type="checkbox" name="konsumsi[]" value="teh"> Teh</label>
                    <label><input type="checkbox" name="konsumsi[]" value="kopi"> Kopi</label>
                    <label><input type="checkbox" name="konsumsi[]" value="gula"> Gula</label>
                    <label><input type="checkbox" name="konsumsi[]" value="creamer"> Creamer</label>
                    <label><input type="checkbox" name="konsumsi[]" value="kue"> Kue</label>
                    <label><input type="checkbox" name="konsumsi[]" value="lunch"> Lunch</label>
                </div>
                </div>
                <div class="form-group" style="margin-left: 210px;">
    <textarea name="konsumsi_lain" id="konsumsi_lain" class="form-control mt-2" placeholder="Tulis konsumsi tambahan (opsional)"></textarea>
</div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
        </form>
    </div>

    <script>
    document.querySelector('#ruang_rapat_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const kapasitas = selectedOption.getAttribute('data-kapasitas');
        document.querySelector('#kapasitas').value = kapasitas;
        document.querySelector('#jumlah_peserta').max = kapasitas;

        // Reset input jumlah peserta saat ruangan diganti
        document.querySelector('#jumlah_peserta').value = '';
        document.querySelector('#kapasitas-error').style.display = 'none';

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

    document.querySelector('#jumlah_peserta').addEventListener('input', function () {
        const maxKapasitas = parseInt(document.querySelector('#kapasitas').value);
        const jumlahPeserta = parseInt(this.value);
        const errorText = document.querySelector('#kapasitas-error');

        if (jumlahPeserta > maxKapasitas) {
            errorText.style.display = 'block';
            this.setCustomValidity('Jumlah peserta tidak boleh melebihi kapasitas maksimal');
        } else {
            errorText.style.display = 'none';
            this.setCustomValidity('');
        }
    });
</script>


</body>
<?php echo view('footer.php');?>

</html>
