<?php

namespace App\Models;

use CodeIgniter\Model;

class PerlengkapanModel extends Model
{
    protected $table = 'perlengkapan';
    protected $allowedFields = ['ruang_rapat_id', 'nama_barang', 'jumlah'];
    protected $primaryKey = 'id';
}
