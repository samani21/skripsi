<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'tb_resep';
    protected $guarded = [];
    public function ber(){
    	return $this->belongsTo('App\Models\Berobat');
    }
}
