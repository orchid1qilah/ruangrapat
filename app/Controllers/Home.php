<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function post_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'Alamat email harus diisi.',
            'email.exists' => 'Alamat email tidak terdaftar.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (empty($user)) {
                Alert::toast('Alamat email tidak ditemukan.', 'error');
                return back();
            }

            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (!Auth::attempt($data)) {
                Session::flash('error', 'Email atau password salah');
                Alert::toast('Email atau password salah', 'error');
                return back();
            }

            return redirect()->route('home');
        } catch (Exception $error) {
            Alert::toast('Terjadi kesalahan, silakan coba lagi.', 'error');
            return back();
        }
    }

}
