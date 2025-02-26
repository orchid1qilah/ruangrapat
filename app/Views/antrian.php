<!DOCTYPE html>
<html lang="id">
<head>
    <?php echo view('header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Penggunaan Ruang Rapat</title>
    <style>
       body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f1fafb;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #40BFC1;
            margin-bottom: 20px;
        }
        table {
            width: 70%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        table thead {
            background-color: #40BFC1;
            color: #fff;
        }
        table thead th {
            padding: 12px;
            text-align: center;
            font-size: 1rem;
        }
        table tbody td {
            padding: 10px;
            text-align: center;
            font-size: 0.95rem;
            border-bottom: 1px solid #ddd;
        }


        .btn-primary {
            background-color: #40BFC1;
            color: #f1fafb;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: all 0.1s;
        }

        .btn-primary:hover {
            background-color: #f1fafb;
            color: #40BFC1;
            border: 1px solid #40BFC1;
        }
        .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.4); 
    opacity: 0;
    transition: opacity 0.3s ease-in-out; 
}

.modal-content {
    background-color: white;
    padding: 20px;
    width: 60%;
    border-radius: 8px;
    position: relative;
    transform: scale(0.9);
    transition: transform 0.3s ease-in-out; 
}


.modal.show {
    display: flex;
    opacity: 1;
}

.modal.show .modal-content {
    transform: scale(1);
}


        .btn-success {
            background-color:rgb(56, 196, 86);
            color: #f1fafb;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: all 0.1s;
        }


        .btn-danger {
            background-color:rgb(196, 56, 56);
            color: #f1fafb;
            padding: 5px 15px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: all 0.1s;
        }
        .modal-header {
            display: flex;
            justify-content:right;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input[type="date"] {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <br>
        <h1>Jadwal Penggunaan Ruang Rapat</h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <form action="<?= base_url('antrian/filter') ?>" method="get">
                    <div class="d-flex">
                        <p>Periode</p>
                        <input type="date" name="startDate" value="<?= isset($startDate) ? $startDate : '' ?>">
                        <p>To</p>
                        <input type="date" name="endDate" value="<?= isset($endDate) ? $endDate : '' ?>">
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                </form>
            </div>
<br>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Waktu Mulai</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($peminjaman as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama_ruangan']) ?></td>
                            <td><?= esc($item['tanggal_peminjaman']) ?></td>
                            <td><?= esc($item['waktu_mulai']) ?></td>
                            <td>
                                <span class="badge <?= ($item['status'] == 'Diterima') ? 'bg-success' : 
                                    (($item['status'] == 'Ditolak') ? 'bg-danger' : 'bg-secondary') ?>">
                                    <?= esc($item['status']) ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="openModal('modal_detail_<?= $item['id'] ?>')">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php foreach ($peminjaman as $item) : ?>
        <div class="modal" id="modal_detail_<?= $item['id'] ?>">
            <div class="modal-content">
                <div class="modal-body">
                <div class="modal-header">
              <button class="btn btn-danger" onclick="closeModal('modal_detail_<?= $item['id'] ?>')">X</button>
            </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Nama Ruangan</th>
                                    <th>Layout</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Acara</th>
                                    <th>Keterangan Acara</th>
                                    <th>Konsumsi</th>
                                    <th>Konsumsi Lain</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= esc($item['nama_ruangan']) ?></td>
                                    <td><?= esc($item['nama_layout']) ?></td>
                                    <td><?= esc($item['tanggal_peminjaman']) ?></td>
                                    <td><?= esc($item['waktu_mulai']) ?></td>
                                    <td><?= esc($item['waktu_selesai']) ?></td>
                                    <td><?= esc($item['acara']) ?></td>
                                    <td><?= esc($item['keterangan_acara']) ?></td>
                                    <td><?= esc($item['konsumsi']) ?></td>
                                    <td><?= esc($item['konsumsi_lain']) ?></td>
                                    <td><?= esc($item['jumlah_peserta']) ?></td>
                                    <td>
                                        <?php if ($item['status'] == 'antrian') : ?>
                                            <a href="<?= base_url("antrian/change_status/{$item['id']}/Diterima") ?>" onclick="ubahStatus" class="btn btn-success ">Diterima</a><br><br>
                                            <a href="<?= base_url("antrian/change_status/{$item['id']}/Ditolak") ?>"  onclick="ubahStatus" class="btn btn-danger ">Ditolak</a>


                                        <?php else : ?>
                                            <span class="btn btn-sm <?= ($item['status'] == 'Diterima') ? 'btn-success' : 'btn-danger' ?>">
                                                <?= esc($item['status']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    

            </div>
        </div>
    <?php endforeach; ?>

    <script>
function openModal(id) {
    document.getElementById(id).classList.add("show");
}

function closeModal(id) {
    document.getElementById(id).classList.remove("show");
}

    </script>
</body>
</html>
