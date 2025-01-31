<?php

namespace App\Controllers;

use App\Models\RuangRapatModel;
use App\Models\InputLayoutModel;
use CodeIgniter\Controller;

class RuangRapatController extends Controller
{
    public function index()
    {
        return redirect()->to('/ruangrapat/list');
    }

    //function create
    public function create()
    {
        $db = \Config\Database::connect();
        $layouts = $db->table('input_layout')->get()->getResultArray();
        return view('input_ruangrapat', ['layouts' => $layouts]);
    }

    //function store
    public function store()
    {
        helper(['form', 'url']);
    
        // Validasi Input
        $validationRules = [
            'nama_ruangan' => 'required|string|max_length[255]',
            'kapasitas'    => 'required|integer|greater_than[0]',
            'layout_id'    => 'required',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }
    
        // Ambil data dari form    
        $nama_ruangan = $this->request->getPost('nama_ruangan');
        $kapasitas = $this->request->getPost('kapasitas');
        $layout_ids = $this->request->getPost('layout_id');
    
        $db = \Config\Database::connect();
    
        // Simpan data ruang rapat
        $ruangRapatModel = new \App\Models\RuangRapatModel();
        $ruangRapatId = $ruangRapatModel->insert([
            'nama_ruangan' => $nama_ruangan,
            'kapasitas'    => $kapasitas,
        ]);
        
        if (!$ruangRapatId) {
        return redirect()->back()->with('error', 'Gagal menyimpan ruang rapat!')->withInput();
    }

    //sv data lay yg di pilih
    foreach ($layout_ids as $layout_id) {
    $db->table('ruang_rapat_layout')->insert([
        'ruang_rapat_id' => $ruangRapatId,
        'layout_id'      => $layout_id,
    ]);
}
        return redirect()->to('/ruangrapat/list')->with('success', 'Data Ruang Rapat berhasil disimpan.');
    } 
    
    //function list
    public function list()
    {
        $db = \Config\Database::connect();
    
        $query = $db->table('ruang_rapat')
        ->select('ruang_rapat.id, ruang_rapat.nama_ruangan, ruang_rapat.kapasitas, GROUP_CONCAT(input_layout.nama_layout SEPARATOR ", ") as nama_layout')
        ->join('ruang_rapat_layout', 'ruang_rapat.id = ruang_rapat_layout.ruang_rapat_id', 'left')
        ->join('input_layout', 'ruang_rapat_layout.layout_id = input_layout.id', 'left')
        ->groupBy('ruang_rapat.id')
        ->get();
        $data['ruang_rapat'] = $query->getResultArray();

        if (empty($data['ruang_rapat'])) {
            return redirect()->to('/ruangrapat/list')->with('error', 'Data ruang rapat tidak ditemukan!');
        }
        
      //  $data['ruang_rapat'] = $query->getResultArray();
        return view('list_master_ruangrapat', $data);
    }

    //function show
    public function show($id)
    {
        $model = new InputLayoutModel();
        $data = $model->getLayout($id);

        echo json_encode(array("path" => base_url('uploads/' . $data['image_path'])));
    }

    //function delete
    public function delete($id)
    {
        $model = new RuangRapatModel();

        if ($model->find($id)) {
            $model->delete($id);
            return redirect()->to('/ruangrapat/list')->with('success', 'Ruang Rapat berhasil dihapus');
        } 
    }

//function edit
public function edit($id)
{
    $db = \Config\Database::connect();

    
    $ruangRapatModel = new \App\Models\RuangRapatModel();
    $ruangRapat = $ruangRapatModel->find($id);

    if (!$ruangRapat) {
        return redirect()->to('/ruangrapat/list')->with('error', 'Data ruang rapat tidak ditemukan!');
    }

    $layouts = $db->table('input_layout')->get()->getResultArray();

   
    $selectedLayouts = $db->table('ruang_rapat_layout')
        ->where('ruang_rapat_id', $id)
        ->get()
        ->getResultArray();

    $selectedLayoutIds = array_column($selectedLayouts, 'layout_id');

    return view('edit_master_ruangrapat', [
        'ruangRapat' => $ruangRapat,
        'layouts' => $layouts,
        'selectedLayoutIds' => $selectedLayoutIds,
    ]);
}

//function update
public function update($id)
{
    helper(['form', 'url']);

    $validationRules = [
        'nama_ruangan' => 'required|string|max_length[255]',
        'kapasitas'    => 'required|integer|greater_than[0]',
        'layout_id'    => 'required',
    ];

    if (!$this->validate($validationRules)) {
        return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
    }

    $nama_ruangan = $this->request->getPost('nama_ruangan');
    $kapasitas = $this->request->getPost('kapasitas');
    $layout_ids = $this->request->getPost('layout_id');

    $db = \Config\Database::connect();
    $ruangRapatModel = new \App\Models\RuangRapatModel();

    $ruangRapatModel->update($id, [
        'nama_ruangan' => $nama_ruangan,
        'kapasitas'    => $kapasitas,
    ]);

    $db->table('ruang_rapat_layout')->where('ruang_rapat_id', $id)->delete();

    foreach ($layout_ids as $layout_id) {
        $db->table('ruang_rapat_layout')->insert([
            'ruang_rapat_id' => $id,
            'layout_id'      => $layout_id,
        ]);
    }

    return redirect()->to('/ruangrapat/list')->with('success', 'Data Ruang Rapat berhasil diperbarui.');
}

}
