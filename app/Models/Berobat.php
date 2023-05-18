<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berobat extends Model
{
    use HasFactory;
    protected $table = 'tb_berobat';
    protected $guarded = [];

    // public function pasi(){
    // 	return $this->belongsTo('App\Models\Pasien');
    // }
}
