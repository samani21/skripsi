<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index(Request $request){
        // $nama = $request->nama;
        $jadwal = DB::table('tb_jadwal')->leftJoin('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')->paginate(6);
 
        return view('petugas/petugas', ['jadwal'=>$jadwal,'title' => 'Petugas'] );
    }
}
