<?php

namespace App\Http\Controllers;

use App\Models\Berobat;
use App\Models\Diagnosa;
use App\Models\Icd;
use App\Models\Medis;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedisController extends Controller
{
    public function periksa(Request $request,$id)
    {   
        $tgl = $request->tgl;
        $berobat = Berobat::find($id);
        $dokter = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('status','=','1')->where('kelompok','=','dokter')->where('tgl','=',"".$tgl."")->paginate(100);
        $perawat = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('status','=','1')->where('kelompok','=','perawat')->where('tgl','=',"".$tgl."")->paginate(100);
        $icd = Icd::all();
        $data['title'] = 'Periksa pasien';
        return view('medis/periksa_fisik',compact(['berobat','dokter','perawat','icd']), $data);
    }
    public function store(Request $request , $id){
        $medis = new Medis([
            'berobat_id' => $request->berobat_id,
            'tgl' => $request->tgl,
            'umur' => $request->umur,
            'dokter' => $request->dokter,
            'perawat' => $request->perawat,
            'sistolik' => $request->sistolik,
            'diastolik' => $request->diastolik,
            'saturasi' => $request->saturasi,
            'suhu' => $request->suhu,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'keluhan' => $request->keluhan,
            'tindakan' => $request->tindakan,
            'napas' => $request->napas,
            'biaya' => $request->biaya,
            'keterangan' => $request->keterangan,
        ]);
        $medis->save();

        $ubah = Berobat::findorfail($id);
        $dt =[
            'status' => $request['status'],
        ];
        $diagnosa = new Diagnosa([
            'berobat_id' => $request->berobat_id,
            'diagnosa' => $request->diagnosa,
        ]);
        $diagnosa->save();
        $ubah->update($dt);
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect('medis/medis?tgl='.date('d-m-Y').'');
    }

    public function rekam($id,$pasien_id){
        $berobat = Berobat::find($id);
        $pasien = Pasien::find($pasien_id);
        $resep = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('berobat_id','=',''.$id.'')->get();
        $data['title'] = 'Rekam medis pasien';
        return view('medis/rekam_medis',['berobat' =>$berobat,'pasien' =>$pasien,'resep'=>$resep],$data);
    }
}
