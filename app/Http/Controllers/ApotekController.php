<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Berobat;

class ApotekController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'Dashboard';
        $tgl = $request->tgl;
        $tahun = $request->tahun;
        $pegawai = DB::table('tb_pegawai')->paginate();
        $dokter = DB::table('tb_petugas')->where('kelompok','like','dokter','')->paginate();
        $perawat = DB::table('tb_petugas')->where('kelompok','like','perawat','')->paginate();
        $pasien = DB::table('tb_pasien')->paginate();
        $berobat = DB::table('tb_berobat')->where('tgl','like',"%".$tgl."%");
        $bulan =  Berobat::select(DB::raw("MONTHNAME(created_at) as ba"))
        ->where('tahun','=',"".$tahun."")
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->pluck('ba');
        $jum =  Berobat::select(DB::raw("COUNT(bulan) as jumlah"))
        ->where('tahun','=',"".$tahun."")
        ->GroupBy(DB::raw("Month(created_at)"))
        ->pluck('jumlah');
        $obatmasuk = DB::table('tb_obatmasuk')->where('tgl','like',"%".$tgl."%");
        $obatkeluar = DB::table('tb_resep')->where('tgl','like',"%".$tgl."%");
        $obat = DB::table('tb_obat')->paginate();
         return view('dashboard/dashboard', ['pegawai' => $pegawai,'dokter' => $dokter, 'bulan' => $bulan, 'jum'=> $jum,'perawat' => $perawat,'pasien' => $pasien,'berobat' => $berobat,'obat' => $obat,'obatmasuk' => $obatmasuk,'obatkeluar' => $obatkeluar,'title'=>'Dashboard'] );
    }

    public function dashboard(Request $request){
        $tgl = $request->tgl;
        // $pegawai = DB::table('tb_pegawai')->paginate();
        // $dokter = DB::table('tb_pelayanan')->where('kelompok','like','dokter','')->paginate();
        // $perawat = DB::table('tb_pelayanan')->where('kelompok','like','perawat','')->paginate();
        // $pasien = DB::table('tb_pasien')->paginate();
        // $berobat = DB::table('tb_berobat')->where('tgl','like',"%".$tgl."%");
        // $obatmasuk = DB::table('tb_obatmasuk')->where('tgl','like',"%".$tgl."%");
        // $obatkeluar = DB::table('tb_resep')->where('tgl','like',"%".$tgl."%");
        // $obat = DB::table('tb_obat')->paginate();
         return view('dashboard/dashboard', ['title'=>'Dashboard'] );
    }
    public function verify(EmailVerificationRequest $request){
        $request->fulfill();
        return "view('dashboard')";
    }
    public function send(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return "verifikasi email berhasil dikirim";
    }
}
