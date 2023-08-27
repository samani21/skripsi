<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class BiayaController extends Controller
{
    public function laporan(Request $request)
    {
        $jenis = $request->jenis;
        $tgl = $request->cari;
        if(Auth::user()->level == 'operator'){
            $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate(5);
        $p_bpjs = DB::table('tb_biaya')->where('j_berobat','=','BPJS')
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->get();
        $p_umum = DB::table('tb_biaya')->where('j_berobat','=','UMUM')
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->get();
        $total = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->get();
        $b_bpjs = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->where('j_berobat','=','BPJS')->get();
        $b_umum = DB::table('tb_biaya')
        ->where('biaya','not like','-')
        ->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','UMUM')->get();
        $biaya->withPath('biaya?cari='.date('Y-m-d').'&');
        }
        if(Auth::user()->level == 'admin'){
            $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->where('j_berobat','=',''.$jenis.'')
        ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate(5);
        $pasien = DB::table('tb_biaya')->where('j_berobat','=',''.$jenis.'')
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->get();
        $total = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')
        ->where('biaya','not like','-')
        ->where('j_berobat','=',''.$jenis.'')
        ->get();
        $biaya->withPath('biaya?cari='.date('Y-m-d').'&jenis='.$jenis.'');
        }
        $data['title'] = 'Laporan Pemasukkan';
        if(Auth::user()->level == 'admin'){
            return view('laporan/biaya',compact('biaya','total','pasien','jenis'),$data);
        }
        if(Auth::user()->level == 'operator'){
             return view('laporan/biaya',compact('biaya','total','p_bpjs','p_umum','b_bpjs','b_umum'),$data);
        }
    }

    public function cetak_biaya(Request $request){
        
        $tgl = $request->cari;
        $dari = $request->dari;
        $sampai = $request->sampai;
        $jenis = $request->jenis;

        if(Auth::user()->level == 'admin'){
            if($tgl = $tgl){
                $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
                ->where('j_berobat','=',''.$jenis.'')
                ->where('nama','like',"%".$tgl."%")
                ->where('biaya','not like','-')
                ->orWhere('j_berobat','like',"%".$tgl."%")
                ->orWhere('poli','like',"%".$tgl."%")
                ->orWhere('status','like',"%".$tgl."%")
                ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate();
                $pasien = DB::table('tb_biaya')
                ->where('biaya','not like','-')->where('j_berobat','=',''.$jenis.'')
                ->where('tgl','=',''.$tgl.'')->get();
                $total = DB::table('tb_biaya')
                ->where('j_berobat','=',''.$jenis.'')
                ->where('biaya','not like','-')->select(DB::raw('sum(biaya) as total'))
                ->where('tgl','=',''.$tgl.'')->get();
                $a = "1";
            }else{
                $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
                ->whereBetween('tgl',[$dari,$sampai])
                ->where('j_berobat','=',''.$jenis.'')
                ->where('biaya','not like','-')
                ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate();
                $pasien = DB::table('tb_biaya')
                ->whereBetween('tgl',[$dari,$sampai])
                ->where('biaya','not like','-')
                ->where('j_berobat','=',''.$jenis.'')
                ->get();
                $total = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
                ->whereBetween('tgl',[$dari,$sampai])
                ->where('biaya','not like','-')
                ->where('j_berobat','=',''.$jenis.'')
                ->get();
                $a = "0";
            }
            $akun = 'admin';
        }
        if($tgl = $tgl){
            $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
            ->where('nama','like',"%".$tgl."%")
            ->where('biaya','not like','-')
            ->orWhere('j_berobat','like',"%".$tgl."%")
            ->orWhere('poli','like',"%".$tgl."%")
            ->orWhere('status','like',"%".$tgl."%")
            ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate();
            $p_bpjs = DB::table('tb_biaya')
            ->where('biaya','not like','-')->where('j_berobat','=','BPJS')
            ->where('tgl','=',''.$tgl.'')->get();
            $p_umum = DB::table('tb_biaya')
            ->where('biaya','not like','-')->where('j_berobat','=','UMUM')
            ->where('tgl','=',''.$tgl.'')->get();
            $total = DB::table('tb_biaya')
            ->where('biaya','not like','-')->select(DB::raw('sum(biaya) as total'))
            ->where('tgl','=',''.$tgl.'')->get();
            $b_bpjs = DB::table('tb_biaya')
            ->where('biaya','not like','-')->select(DB::raw('sum(biaya) as total'))
            ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','BPJS')->get();
            $b_umum = DB::table('tb_biaya')
            ->where('biaya','not like','-')->select(DB::raw('sum(biaya) as total'))
            ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','UMUM')->get();
            $a = "1";
        }else{
            $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
            ->whereBetween('tgl',[$dari,$sampai])
            ->where('biaya','not like','-')
            ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate();
            $p_bpjs = DB::table('tb_biaya')->where('j_berobat','=','BPJS')
            ->whereBetween('tgl',[$dari,$sampai])
            ->where('biaya','not like','-')
            ->get();
            $p_umum = DB::table('tb_biaya')->where('j_berobat','=','UMUM')
            ->whereBetween('tgl',[$dari,$sampai])
            ->where('biaya','not like','-')
            ->get();
            $total = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
            ->whereBetween('tgl',[$dari,$sampai])
            ->where('biaya','not like','-')
            ->get();
            $b_bpjs = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
            ->whereBetween('tgl',[$dari,$sampai])
            ->where('biaya','not like','-')
            ->where('j_berobat','=','BPJS')->get();
            $b_umum = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
            ->whereBetween('tgl',[$dari,$sampai])
            ->where('biaya','not like','-')
            ->where('j_berobat','=','UMUM')->get();
            $a = "0";
            $akun = 'operator';
        }
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        if(Auth::user()->level == 'admin'){
            $pdf =     PDF::loadView('biaya/cetak',compact('akun','biaya','total','pasien','tgl','kapus','a','dari','sampai'));
        }
        if(Auth::user()->level == 'operator'){
            $pdf =     PDF::loadView('biaya/cetak',compact('akun','biaya','total','p_bpjs','p_umum','b_bpjs','b_umum','tgl','kapus','a','dari','sampai'));
        }
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obatmasuk.pdf');
    }
}
