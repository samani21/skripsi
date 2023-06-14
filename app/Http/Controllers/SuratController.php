<?php

namespace App\Http\Controllers;

use App\Models\Berobat;
use App\Models\Biaya;
use App\Models\Medis;
use App\Models\Pasien;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class SuratController extends Controller
{
    public function surat_sakit($id,$medis,$berobat){
        $pasien = Pasien::find($id);
        $medis = Medis::find($medis);
        $berobat = Berobat::find($berobat);
        $data['title'] = 'Surat sakit';
        return view('medis/surat_sakit',compact(['pasien','medis','berobat']),$data);
    }

    public function sakit(Request $request,$berobat)
    {
        $b= $request->pasien_id;
        $a= $request->berobat_id;
        $surat = new Surat([
            'pasien_id' => $request->pasien_id,
            'medis_id' => $request->medis_id,
            'pekerjaan' => $request->pekerjaan,
            'tgl1' => $request->tgl1,
            'tgl2' => $request->tgl2,
            'riwayat' => $request->riwayat,
            'keperluan' => $request->keperluan,
            'berobat_id' => $request->berobat_id,
            'status' => $request->status,
        ]);
        $biaya = new Biaya([
            'pasien_id' => $request->pasien_id,
            'poli' => $request->poli,
            'j_berobat' => $request->j_berobat,
            'biaya' => $request->biaya,
            'status' => $request->sb,
            'tgl' => $request->tgl_b,
        ]);
        $ubah = Berobat::findorfail($berobat);
        $dt =[
            'status' => $request['status1'],
        ];
        $ubah->update($dt);
        $surat->save();
        $biaya->save();
        Alert()->success('SuccessAlert','Tambah data berhasil');
        return redirect('medis/rekam_medis/berobat='.$a.'&rekammedis='.$b.'');
    }
    
    public function cetak_sakit($id,$medis){
       
        $surat = DB::table('tb_surat')->join('tb_pasien','tb_pasien.id_pasien','=','tb_surat.pasien_id')
        ->join('tb_medis','tb_medis.id','=','tb_surat.medis_id')
        ->where('id_pasien','=',''.$id.'')->where('status','=','1')->get();
        $pdf = PDF::loadView('medis/cetak_sakit',compact('surat'));;
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_surat_sakit.pdf');
    }

    public function surat_sehat($id,$medis,$berobat){
        $pasien = Pasien::find($id);
        $medis = Medis::find($medis);
        $berobat = Berobat::find($berobat);
        $data['title'] = 'Surat Sehat';
        return view('medis/surat_sehat',compact(['pasien','medis','berobat']),$data);
    }

    public function sehat(Request $request,$berobat)
    {
        $b= $request->pasien_id;
        $a= $request->berobat_id;
        $surat = new Surat([
            'pasien_id' => $request->pasien_id,
            'medis_id' => $request->medis_id,
            'pekerjaan' => $request->pekerjaan,
            'tgl1' => $request->tgl1,
            'tgl2' => $request->tgl2,
            'riwayat' => $request->riwayat,
            'keperluan' => $request->keperluan,
            'status' => $request->status,
            'keperluan' => $request->keperluan,
        ]);
        $biaya = new Biaya([
            'pasien_id' => $request->pasien_id,
            'poli' => $request->poli,
            'j_berobat' => $request->j_berobat,
            'biaya' => $request->biaya,
            'status' => $request->sb,
            'tgl' => $request->tgl_b,
        ]);
        $ubah = Berobat::findorfail($berobat);
        $dt =[
            'status' => $request['status1'],
        ];
        $ubah->update($dt);
        $surat->save();
        $biaya->save();
        Alert()->success('SuccessAlert','Tambah data berhasil');
        return redirect('medis/rekam_medis/berobat='.$a.'&rekammedis='.$b.'');
    }
    
    public function cetak_sehat($id,$medis){
       
        $surat = DB::table('tb_surat')->join('tb_pasien','tb_pasien.id_pasien','=','tb_surat.pasien_id')
        ->join('tb_medis','tb_medis.id','=','tb_surat.medis_id')
        ->where('id_pasien','=',''.$id.'')->where('status','=','2')->get();
        $pdf = PDF::loadView('medis/cetak_sehat',compact('surat'));;
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_surat_sakit.pdf');
    }
}
