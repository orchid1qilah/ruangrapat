<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'ruang_rapat_id', 
        'kapasitas',
        'jumlah_peserta',
        'tanggal_peminjaman',
        'waktu_mulai',
        'waktu_selesai',
        'acara',
        'keterangan_acara',
        'konsumsi',
        'konsumsi_lain',
        'layout_id'
    ];
    protected $useTimestamps = true;
}
