<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class BiayaController extends Controller
{
    public function laporan(Request $request)
    {
        $tgl = $request->cari;
        $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
        ->where('tgl','=',''.$tgl.'')
        ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate(5);
        $p_bpjs = DB::table('tb_biaya')->where('j_berobat','=','BPJS')
        ->where('tgl','=',''.$tgl.'')->get();
        $p_umum = DB::table('tb_biaya')->where('j_berobat','=','UMUM')
        ->where('tgl','=',''.$tgl.'')->get();
        $total = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->get();
        $b_bpjs = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','BPJS')->get();
        $b_umum = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','UMUM')->get();
        $data['title'] = 'Laporan Pemasukkan';
        $biaya->withPath('biaya?tgl='.date('d-m-Y').'&');
        return view('laporan/biaya',compact('biaya','total','p_bpjs','p_umum','b_bpjs','b_umum'),$data);
    }

    public function cetak_biaya(Request $request){
        
        $tgl = $request->cari;
        $biaya = DB::table('tb_biaya')->join('tb_pasien','tb_pasien.id_pasien','=','tb_biaya.pasien_id')
        ->where('tgl','=',''.$tgl.'')
        ->select('pasien_id','no_berobat','nama','j_berobat','poli','biaya','tgl','status')->paginate();
        $p_bpjs = DB::table('tb_biaya')->where('j_berobat','=','BPJS')
        ->where('tgl','=',''.$tgl.'')->get();
        $p_umum = DB::table('tb_biaya')->where('j_berobat','=','UMUM')
        ->where('tgl','=',''.$tgl.'')->get();
        $total = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->get();
        $b_bpjs = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','BPJS')->get();
        $b_umum = DB::table('tb_biaya')->select(DB::raw('sum(biaya) as total'))
        ->where('tgl','=',''.$tgl.'')->where('j_berobat','=','UMUM')->get();
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $pdf = PDF::loadView('biaya/cetak',compact('biaya','total','p_bpjs','p_umum','b_bpjs','b_umum','tgl','kapus'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obatmasuk.pdf');
    }
}
