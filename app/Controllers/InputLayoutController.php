<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class InputLayoutController extends Controller
{
    public function index()
    {
        return view('input_layout');
    }

    public function upload()
    {
        helper(['form', 'url']);

        $validationRules = [
            'nama_layout.*' => 'required',
            'image_layout.*' => [
                'uploaded[image_layout]',
                'mime_in[image_layout,image/png,image/jpeg]',
                'max_size[image_layout,2048]',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $namaLayout = $this->request->getPost('nama_layout');
        $files = $this->request->getFiles();

        $db = \Config\Database::connect();
        foreach ($files['image_layout'] as $index => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getClientName();
                $file->move('uploads', $newName);
            
                $data = [
                    'nama_layout' => $namaLayout[$index],
                    'image_path'  => $newName,
                ];

                $db->table('input_layout')->insert($data);
            }
        }

        return redirect()->to('/inputlayout/list')->with('success', 'File berhasil diunggah!');
       // return redirect()->to('/inputlayout/list')->with('success', 'Layout berhasil dihapus!');

    }

    public function list()
    {
        $db = \Config\Database::connect();
        $query = $db->table('input_layout')->get();
        $data['layouts'] = $query->getResultArray();

        return view('list_layout', $data);
    }


    public function delete($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('input_layout')->where('id', $id)->get()->getRowArray();

        if ($query) {
            $filePath = 'uploads/' . $query['image_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $db->table('input_layout')->delete(['id' => $id]);
        }

        return redirect()->to('/inputlayout/list')->with('success', 'Layout berhasil dihapus!');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $layout = $db->table('input_layout')->where('id', $id)->get()->getRowArray();

        if (!$layout) {
            return redirect()->to('/inputlayout/list')->with('error', 'Layout tidak ditemukan!');
        }

        return view('edit_input_layout', ['layout' => $layout]);
    }

    public function update($id)
    {
        helper(['form', 'url']);
        $db = \Config\Database::connect();

        $validationRules = [
            'nama_layout' => 'required',
            'image_layout' => [
                'mime_in[image_layout,image/png,image/jpeg]',
                'max_size[image_layout,2048]',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $namaLayout = $this->request->getPost('nama_layout');
        $file = $this->request->getFile('image_layout');

        $data = ['nama_layout' => $namaLayout];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $oldData = $db->table('input_layout')->where('id', $id)->get()->getRowArray();
            $oldFilePath = 'uploads/' . $oldData['image_path'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $newName = $file->getClientName();
            $file->move('uploads', $newName);
            $data['image_path'] = $newName;
        }

        $db->table('input_layout')->update($data, ['id' => $id]);

        return redirect()->to('/inputlayout/list')->with('success', 'Layout berhasil diperbarui!');
    }

}
