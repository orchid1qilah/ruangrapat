<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\RuangRapatModel;
use App\Models\InputLayoutModel;
use CodeIgniter\Controller;

class AntrianController extends Controller
{
    public function index()
    {
        $peminjamanModel = new PeminjamanModel();

        $data['peminjaman'] = $peminjamanModel->select('peminjaman.*, ruang_rapat.nama_ruangan, input_layout.nama_layout, peminjaman.status')
            ->join('ruang_rapat', 'peminjaman.ruang_rapat_id = ruang_rapat.id', 'left')
            ->join('input_layout', 'peminjaman.layout_id = input_layout.id', 'left')
            ->orderBy('peminjaman.tanggal_peminjaman', 'DESC')
            ->findAll();

        return view('antrian', $data);
    }


    public function filter()
    {
        $peminjamanModel = new PeminjamanModel();

        $startDate = $this->request->getGet('startDate');
        $endDate = $this->request->getGet('endDate');

        $query = $peminjamanModel->select('peminjaman.*, ruang_rapat.nama_ruangan, input_layout.nama_layout, peminjaman.status')
            ->join('ruang_rapat', 'peminjaman.ruang_rapat_id = ruang_rapat.id', 'left')
            ->join('input_layout', 'peminjaman.layout_id = input_layout.id', 'left');

        if ($startDate && $endDate) {
            $query->where('peminjaman.tanggal_peminjaman >=', $startDate)
                  ->where('peminjaman.tanggal_peminjaman <=', $endDate);
        }

        $data['peminjaman'] = $query->orderBy('peminjaman.tanggal_peminjaman', 'DESC')->findAll();
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view('antrian', $data);
    }


    public function change_status($id, $status)
    {
        $peminjamanModel = new PeminjamanModel();
        
        $peminjamanModel->update($id, ['status' => $status]);

        session()->setFlashdata('success', 'Sukses Merubah Status');
        return redirect()->to('/antrian');
    }


    
}
