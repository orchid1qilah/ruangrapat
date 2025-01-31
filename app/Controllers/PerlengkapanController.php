<?php

namespace App\Controllers;

use App\Models\PerlengkapanModel;
use App\Models\RuangRapatModel;
use CodeIgniter\Controller;

class PerlengkapanController extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        $query = $db->table('perlengkapan')
            ->select('perlengkapan.*, ruang_rapat.nama_ruangan')
            ->join('ruang_rapat', 'perlengkapan.ruang_rapat_id = ruang_rapat.id', 'left')
            ->get();

        $data['perlengkapan'] = $query->getResultArray();
        return view('list_perlengkapan', $data);
    }

    //function u create
    public function create()
    {
        $ruangRapatModel = new \App\Models\RuangRapatModel();
        $data['ruangan'] = $ruangRapatModel->findAll();
        return view('input_perlengkapan', $data);
    }

    //function u store
    public function store()
    {
        helper(['form', 'url']);

        $validationRules = [
            'ruang_rapat_id' => 'required',
            'nama_barang.*'  => 'required|string|max_length[255]',
            'jumlah.*'       => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $ruangRapatId = $this->request->getPost('ruang_rapat_id');
        $namaBarang = $this->request->getPost('nama_barang');
        $jumlah = $this->request->getPost('jumlah');

        $perlengkapanModel = new \App\Models\PerlengkapanModel();

        foreach ($namaBarang as $key => $barang) {
            $perlengkapanModel->insert([
                'ruang_rapat_id' => $ruangRapatId,
                'nama_barang'    => $barang,
                'jumlah'         => $jumlah[$key],
            ]);
        }

        return redirect()->to('/perlengkapan')->with('success', 'Data perlengkapan berhasil disimpan.');
    }

    //function u edit
    public function edit($id)
    {
        $perlengkapanModel = new \App\Models\PerlengkapanModel();
        $ruangRapatModel = new \App\Models\RuangRapatModel();
    
        $data['perlengkapan'] = $perlengkapanModel->find($id);
        $data['ruangan'] = $ruangRapatModel->findAll();
    
        if (!$data['perlengkapan']) {
            return redirect()->to('/perlengkapan')->with('error', 'Data perlengkapan tidak ditemukan.');
        }
    
        return view('edit_perlengkapan', $data);
    }
    
    //function u update
    public function update($id)
    {
        helper(['form', 'url']);
    
        $validationRules = [
            'ruang_rapat_id' => 'required',
            'nama_barang'    => 'required|string|max_length[255]',
            'jumlah'         => 'required|integer|greater_than[0]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }
    
        $perlengkapanModel = new \App\Models\PerlengkapanModel();
    //coba1
        $data = [
            'ruang_rapat_id' => $this->request->getPost('ruang_rapat_id'),
            'nama_barang'    => $this->request->getPost('nama_barang'),
            'jumlah'         => $this->request->getPost('jumlah'),
        ];
    
        $perlengkapanModel->update($id, $data);
    
       return redirect()->to('/perlengkapan')->with('success', 'Data perlengkapan berhasil diperbarui.');
    }

}
