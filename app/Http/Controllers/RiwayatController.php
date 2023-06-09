<?php

namespace App\Http\Controllers;

use App\Models\Berobat;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index(Request $request){
        $nik = $request->nik;
        $password = $request->password;
        $pasien = DB::table('tb_pasien')->where('nik','=',''.$nik.'')->where('password','=',''.$password.'')->get();
        $berobat = DB::table('tb_berobat')->where('nik','=',''.$nik.'')->where('password','=',''.$password.'')->paginate(6);
        return view('riwayat/riwayat', ['pasien' => $pasien,'berobat'=>$berobat]);
    }

    public function rekam($id,$pasien_id)
    {
        $berobat = Berobat::find($id);
        $pasien = Pasien::find($pasien_id);
        $surat = DB::table('tb_surat')->where('berobat_id','=',''.$id.'')->get();
        $resep = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('berobat_id','=',''.$id.'')->get();
        return view('riwayat/rekam_medis',['berobat' =>$berobat,'pasien' =>$pasien,'resep'=>$resep,'surat'=>$surat]);
    }
}
