<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berobat extends Model
{
    use HasFactory;
    protected $table = 'tb_berobat';
    protected $guarded = [];

    public function medis(){
    	return $this->hasOne('App\Models\Medis');
    }

    // public function pasien(){
    // 	return $this->hasOne('App\Models\Pasien');
    // }

    public function diagnosa(){
    	return $this->hasMany('App\Models\Diagnosa');
    }

    public function resep(){
    	return $this->hasMany('App\Models\Obat');
    }
    // public function pasi(){
    // 	return $this->belongsTo('App\Models\Pasien');
    // }
}
