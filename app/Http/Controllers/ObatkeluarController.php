<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatkeluarController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $resep = DB::table('tb_berobat')->join('tb_resep','tb_resep.berobat_id','=','tb_berobat.id')
        ->join('tb_pasien','tb_pasien.id_pasien','=','tb_berobat.pasien_id')
        ->select('tb_berobat.id',DB::raw('count(tb_resep.berobat_id) as jm'),'tb_berobat.status','tb_berobat.poli','tb_berobat.tgl','tb_pasien.nama','tb_pasien.no_berobat','tb_berobat.pasien_id')
        // ->select(DB::raw('count(tb_resep.berobat_id) as jm'))
        ->groupBy('tb_berobat.id','tb_pasien.no_berobat','tb_berobat.pasien_id','tb_berobat.status','tb_pasien.nama','tb_berobat.tgl','tb_berobat.poli')
        ->orderBy('tb_berobat.tgl','asc')
        ->where('tb_pasien.nama','like',"%".$cari."%")
        ->orWhere('tb_berobat.poli','like',"%".$cari."%")
        ->paginate(10);
       
        return view('resep/resep', ['resep' => $resep,'title' => 'Resep Pasien'] );
    }
}
