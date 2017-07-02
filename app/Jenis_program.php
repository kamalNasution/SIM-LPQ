<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_program extends Model
{
  protected $table = 'jenis_program';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nama', 'enrollment_pengajar'
  ];

  function daftar_jenjang() {
      return $this->hasMany('App\Jenjang', 'id_jenis_program');
  }

}
