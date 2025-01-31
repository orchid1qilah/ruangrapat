<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangRapatModel extends Model
{
    protected $table = 'ruang_rapat';
    protected $allowedFields = ['nama_ruangan', 'kapasitas', 'layout_id'];
    protected $primaryKey = 'id';
}
