<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class registrasi extends Controller
{
    public function cekemail(Request $req)
    {
      $email = User::where('email', $req['email'])->first();

      if (empty($email)) {
        echo "kosong";
      }else {
        echo "ada";
      }
    }
    public function regis(Request $req)
    {
      // dd($req);
      $this->validate($req, [
        'nama_depan' => ['required', 'string', 'max:255'],
        'nama_belakang' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'no_telp' => ['required', 'string', 'max:12'],
        'password' => ['required', 'string', 'min:8'],
      ]);
      User::create([
          'nama_depan' => $req['nama_depan'],
          'nama_belakang' => $req['nama_belakang'],
          'email' => $req['email'],
          'no_telp' => $req['no_telp'],
          'password' => Hash::make($req['password']),
      ]);
      return view('berhasil');
    }
}
