<?php

namespace App\Models;

use CodeIgniter\Model;

class InputLayoutModel extends Model
{
    protected $table = 'input_layout';
    protected $allowedFields = ['id', 'nama_layout', 'image_path'];
    protected $primaryKey = 'id';

    public function getLayout($id)
    {
        return $this->where('id', $id)
                    ->first();
    }
}
