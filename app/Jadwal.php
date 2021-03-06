<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{

      protected $table = 'jadwal';

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'waktu'
      ];

      public function pengajar() {
        return $this->belongsTo('App\Pengajar', 'id_pengajar');
      }

      public function kelompok() {
        return $this->hasOne('App\Kelompok', 'id_jadwal');
      }

      public function getWaktuAttribute($value)
      {
          return date('H:i', strtotime($value));
      }

}
