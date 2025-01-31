<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\RuangRapatModel;
use App\Models\InputLayoutModel;
use CodeIgniter\Controller;

class PeminjamanController extends Controller
{

    public function index()
    {
        $peminjamanModel = new PeminjamanModel();
        $ruangRapatModel = new RuangRapatModel();
        $inputLayoutModel = new InputLayoutModel();
    
        $peminjaman = $peminjamanModel->findAll();
    
        foreach ($peminjaman as &$item) {
            $ruang = $ruangRapatModel->find($item['ruang_rapat_id']);
            $layout = $inputLayoutModel->find($item['layout_id']);
    
            $item['nama_ruangan'] = $ruang ? $ruang['nama_ruangan'] : 'Unknown';
            $item['nama_layout'] = $layout ? $layout['nama_layout'] : 'Unknown';
        }
    
        return view('jadwal_rr_all', ['peminjaman' => $peminjaman]);
    }
    

    public function create()
    {
        $db = \Config\Database::connect();
    
        $ruangRapatModel = new RuangRapatModel();
        $ruangan = $ruangRapatModel->findAll();
    
        $ruanganWithLayouts = [];
        foreach ($ruangan as $ruang) {
            $layouts = $db->table('ruang_rapat_layout')
                ->select('input_layout.id, input_layout.nama_layout, input_layout.image_path')
                ->join('input_layout', 'ruang_rapat_layout.layout_id = input_layout.id')
                ->where('ruang_rapat_layout.ruang_rapat_id', $ruang['id'])
                ->get()
                ->getResultArray();
            
            $ruang['layouts'] = $layouts;
            $ruanganWithLayouts[] = $ruang;
        }
    
        $data = [
            'ruangan' => $ruanganWithLayouts,
        ];
   // return view('jadwal_rr_all', $data);
       return view('form_peminjaman', $data);
    }
    public function store()
    {
        helper(['form', 'url']);
    
        $validationRules = [
            'ruang_rapat_id'     => 'required|integer',
            'kapasitas'          => 'required|integer|greater_than[0]',
            'tanggal_peminjaman' => 'required|valid_date',
            'waktu_mulai'        => 'required',
            'waktu_selesai'      => 'required|greater_than_field[waktu_mulai]',
            'acara'              => 'required|in_list[internal,eksternal]',
            'keterangan_acara'   => 'required',
            'layout_id'          => 'required|integer',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }
    
        $data = [
            'ruang_rapat_id'     => $this->request->getPost('ruang_rapat_id'),
            'kapasitas'          => $this->request->getPost('kapasitas'),
            'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
            'waktu_mulai'        => $this->request->getPost('waktu_mulai'),
            'waktu_selesai'      => $this->request->getPost('waktu_selesai'),
            'acara'              => $this->request->getPost('acara'),
            'keterangan_acara'   => $this->request->getPost('keterangan_acara'),
            'konsumsi'           => implode(',', $this->request->getPost('konsumsi') ?? []),
            'konsumsi_lain'      => $this->request->getPost('konsumsi_lain'),
            'layout_id'          => $this->request->getPost('layout_id'),
        ];
    
        $peminjamanModel = new PeminjamanModel();
        $peminjamanModel->insert($data);
    
        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil disimpan.');
    }
    
}
