<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'tb_jadwal';
    protected $guarded = [];
    public function petugas(){
    	return $this->belongsTo('App\Models\Petugas');
    }
}
