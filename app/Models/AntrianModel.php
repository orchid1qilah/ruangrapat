<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'ruang_rapat_id',
        'layout_id',
        'kapasitas',
        'tanggal_peminjaman',
        'waktu_mulai',
        'waktu_selesai',
        'acara',
        'keterangan_acara',
        'konsumsi',
        'konsumsi_lain',
        'jumlah_peserta',
        'status',
        'created_at',
        'updated_at',
    ];
}
