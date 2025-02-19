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
    
        $data['peminjaman'] = $peminjamanModel->select('peminjaman.*, ruang_rapat.nama_ruangan, input_layout.nama_layout')
            ->join('ruang_rapat', 'peminjaman.ruang_rapat_id = ruang_rapat.id', 'left')
            ->join('input_layout', 'peminjaman.layout_id = input_layout.id', 'left')
            ->orderBy('peminjaman.tanggal_peminjaman', 'DESC')
            ->findAll();
    
        return view('jadwal_rr_all', $data);
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
    
        return view('form_peminjaman', $data);
    }
    public function store()
{
    helper(['form', 'url']);

    $validationRules = [
        'ruang_rapat_id'     => 'required|integer',
        'kapasitas'          => 'required|integer|greater_than[0]',
        'tanggal_peminjaman' => 'required|valid_date',
        'waktu_mulai'        => 'required|valid_date',
        'waktu_selesai'      => 'required|valid_date|greater_than_field[waktu_mulai]',
        'acara'              => 'required|in_list[internal,eksternal]',
        'keterangan_acara'   => 'required',
        'layout_id'          => 'required|integer',
    ];

    try {
            //code...
                //throw $th;

            $ruangRapatId = $this->request->getPost('ruang_rapat_id');
            $kapasitas = $this->request->getPost('kapasitas');
            $tanggal_peminjaman = $this->request->getPost('tanggal_peminjaman');
            $waktu_mulai = $this->request->getPost('waktu_mulai');
            $waktu_selesai = $this->request->getPost('waktu_selesai');
            $acara = $this->request->getPost('acara');
            $keterangan_acara = $this->request->getPost('keterangan_acara');
            $layout_id = $this->request->getPost('layout_id');
            $konsumsi = $this->request->getPost('konsumsi');
            $konsumsi_lain = $this->request->getPost('konsumsi_lain');

            // echo $ruangRapatId;
            // die();

            // Validate the form data
            // if (!$this->validate($validationRules)) {
            //     // Join the errors into a single string and display them
            //     echo implode('<br>', $this->validator->getErrors());
            //     die(); // Stop further processing on error
            //     return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
            // }
            
            // Prepare the data to be inserted into the database
            $data = [
                'ruang_rapat_id'     => $ruangRapatId,
                'kapasitas'          => $kapasitas,
                'tanggal_peminjaman' => $tanggal_peminjaman,
                'waktu_mulai'        => $waktu_mulai,
                'waktu_selesai'      => $waktu_selesai,
                'acara'              => $acara,
                'keterangan_acara'   => $keterangan_acara,
                'konsumsi'           => is_array($konsumsi) ? implode(',', $konsumsi) : '', // Ensure it's an array before imploding
                'konsumsi_lain'      => $konsumsi_lain,
                'layout_id'          => $layout_id,
            ];

            // Load the model and insert the data into the database
            $peminjamanModel = new PeminjamanModel();
            if ($peminjamanModel->insert($data)) {
                return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil disimpan.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
            }
        } catch (\Exception $e) {
            echo $e;
            die();
    }

}

    
}