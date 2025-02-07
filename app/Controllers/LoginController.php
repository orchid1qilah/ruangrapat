<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $nik = $this->request->getPost('nik');
        $password = $this->request->getPost('password');
        $company = $this->request->getPost('company');

        $userModel = new UserModel();
        $user = $userModel->validateUser($nik, $password, $company);

        if ($user) {
            return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'NIK, Password, atau Company salah.');
        }
    }
}
