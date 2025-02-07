
<div class="header">
    <div class="logo">Ruang Rapat</div>
    <div class="nav">
        <div class="nav-item">Form</div>
        <div class="nav-item">
            Jadwal &#9662;
            <div class="dropdown">
                <a href="#">Jadwal Harian</a>
                <a href="#">Jadwal Peminjaman</a>
            </div>
        </div>
        <div class="nav-item">Antrian</div>
        <div class="nav-item">Laporan</div>
        <div class="nav-item">
            Master &#9662;
            <div class="dropdown">
                <a href="#">Master Ruang Rapat</a>
                <a href="#">Master Layout RR</a>
                <a href="#">Master Perlengkapan RR</a>
                <a href="#">Master Perlengkapan</a>
            </div>
        </div>
    </div>
    <div class="user-section">
        <span class="icon">&#128100;</span>
        <span>
            <?php 
                echo session()->get('username') ? "Halo, " . session()->get('username') : "Halo, User";
            ?>
        </span>
        <button class="logout-btn" onclick="window.location.href='<?= base_url('logout') ?>'">Log Out</button>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    .header {
        display: flex;
        justify-content: space-between;
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
