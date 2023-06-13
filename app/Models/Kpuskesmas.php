<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpuskesmas extends Model
{
    use HasFactory;
    protected $table = 'tb_kapus';
    protected $guarded = [];
}
