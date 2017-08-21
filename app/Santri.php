<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santri extends Program
{
  protected $table = "santri";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'tahun_kbm_terakhir', 'semester_kbm_terakhir', 'spp_status', 'spp_dibayar', 'spp_keterangan'
  ];

  protected $casts = [
      'tahun_kbm_terakhir' => 'integer',
      'semester_kbm_terakhir' => 'integer',
      'spp_status' => 'integer',
      'spp_dibayar' => 'integer'
  ];

    function jenjang() {
      return $this->belongsTo('App\Jenjang', 'id_jenjang');
    }

    function sudah_lulus() {
      return $this->belongsTo('App\Jenjang', 'id_jenjang_lulus');
    }

    function pengguna() {
        return $this->belongsTo('App\Pengguna', 'id_pengguna');
    }

    function kelompok() {
        return $this->belongsTo('App\Kelompok', 'id_kelompok');
    }

    public function setTahunKBMTerakhirAttribute($value)
    {
        if(intval($value) > intval(date('Y')) || intval($value) < 2011)
          $this->attributes['tahun_kbm_terakhir'] = NULL;
        else
          $this->attributes['tahun_kbm_terakhir'] = intval($value);
    }
}
