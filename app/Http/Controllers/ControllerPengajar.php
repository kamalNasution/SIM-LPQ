<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPengajar extends Controller
{
  /**
   * Menampilkan daftar pengajar kepada admin
   */
  public function index()
  {
      //
      return view('admin.pengajar');
  }

  /**
   * Memproses penambahan pengajar dari member dan admin
   */
  public function tambah()
  {
      //
      //if(Auth::user()->hasRole('admin'));
      //else;
  }

  /**
   * Memproses pengeditan pengajar dari member dan admin
   */
  public function simpan()
  {
      //
      //if(Auth::user()->hasRole('admin'));
      //else;
  }

  /**
   * Memproses penghapusan pengajar dari member dan admin
   */
  public function hapus()
  {
      //
      //if(Auth::user()->hasRole('admin'));
      //else;
  }
}