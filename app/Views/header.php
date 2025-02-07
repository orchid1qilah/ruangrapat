<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Ruang Rapat</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration:none;

        }
        body {
            background-color: #f8f8f8;
            text-decoration:none;

        }
        .header {
            display: flex;
            justify-content: space-between;
            text-decoration:none;
            align-items: center;
            padding: 15px 40px;
            background-color: white;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            background-color: #50c3c8;
            padding: 10px 20px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .nav {
            display: flex;
            gap: 25px;
        }
        .nav-item {
            position: relative;
            cursor: pointer;
            color: #50c3c8;
            font-weight: 500;
        }
        .nav-item:hover .dropdown {
            display: block;
        }
        .dropdown {
            display: none;
            position: absolute;
            top: 25px;
            left: 0;
            background: white;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 180px;
        }
        .dropdown a {
            display: block;
            padding: 10px;
            color: #50c3c8;
            text-decoration: none;
        }
        .dropdown a:hover {
            background-color: #e6f7f8;
        }
        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-section .icon {
            color: #50c3c8;
            font-size: 18px;
        }
        .logout-btn {
            border: 2px solid #50c3c8;
            padding: 8px 15px;
            border-radius: 20px;
            color: #50c3c8;
            background: transparent;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }
        .logout-btn:hover {
            background-color: #50c3c8;
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">Ruang Rapat</div>
        <div class="nav">
        <a href="<?= base_url('peminjaman/create'); ?>" class="nav-item">Form</a>


            <div class="nav-item">
                Jadwal &#9662;
                <div class="dropdown">
                    <a href="#">Jadwal Harian</a>
                    <a href="<?= base_url('peminjaman'); ?>">Jadwal Peminjaman</a>
                </div>
            </div>
            <div class="nav-item">Antrian</div>
            <div class="nav-item">Laporan</div>
            <div class="nav-item">
                Master &#9662;
                <div class="dropdown">
                    <a href="<?= base_url('ruangrapat'); ?>">Master Ruang Rapat</a>
                    <a href="<?= base_url('/inputlayout/list'); ?>">Master Layout RR</a>
                    <a href="<?= base_url('perlengkapan'); ?>">Master Perlengkapan RR</a>
                    <a href="#">Master Perlengkapan</a>
                </div>
            </div>
        </div>
        <div class="user-section">
            <span class="icon">&#128100;</span>
            <span>Halo User</span>
            <button class="logout-btn" onclick="window.location.href='<?= base_url('home'); ?>'">Log Out</button>
            </div>
    </div>

</body>
</html>