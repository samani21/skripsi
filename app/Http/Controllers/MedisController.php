<?php

namespace App\Http\Controllers;

use App\Models\Berobat;
use App\Models\Diagnosa;
use App\Models\Icd;
use App\Models\Medis;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class MedisController extends Controller
{
    public function periksa(Request $request,$id)
    {   
        $poli = $request->poli;
        $tgl = $request->tgl;
        $berobat = Berobat::find($id);
        $dokter = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('status','=','1')->where('kelompok','=','dokter')->where('tgl','=',"".$tgl."")
        // ->where('poli','=','Poli '.$poli.'')
        ->paginate(100);
        $perawat = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('status','=','1')->where('kelompok','=','perawat')->where('tgl','=',"".$tgl."")
        ->where('poli','=','Poli '.$poli.'')->paginate(100);
        $icd = Icd::all();
        $data['title'] = 'Periksa pasien';
        return view('medis/periksa_fisik',compact(['berobat','dokter','perawat','icd']), $data);
    }
    public function store(Request $request , $id)
    {
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
        foreach ($request->addMoreInputFields as $key => $value) {
            Diagnosa::create($value);
        }
        $ubah->update($dt);
        Alert()->success('SuccessAlert','Tambah data berhasil');
        return redirect('medis/medis?tgl='.date('Y-m-d').'');
    }

    public function rekam($id,$pasien_id)
    {
        $berobat = Berobat::find($id);
        $pasien = Pasien::find($pasien_id);
        $surat = DB::table('tb_surat')->where('berobat_id','=',''.$id.'')->get();
        $resep = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('berobat_id','=',''.$id.'')->get();
        $data['title'] = 'Rekam medis pasien';
        return view('medis/rekam_medis',['berobat' =>$berobat,'pasien' =>$pasien,'resep'=>$resep,'surat'=>$surat],$data);
    }

    public function edit_fisik (Request $request,$id,$berobat)
    {
        $tgl = $request->tgl;
        $berobat = Berobat::find($berobat);
        $dokter = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('status','=','1')->where('kelompok','=','dokter')->where('tgl','=',"".$tgl."")->paginate(100);
        $perawat = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('status','=','1')->where('kelompok','=','perawat')->where('tgl','=',"".$tgl."")->paginate(100);
        $icd = Icd::all();
        $fisik = Medis::find($id);
        $data['title'] = 'Edit Rekam medis pasien';
        return view('medis/edit_fisik',compact(['fisik','berobat','dokter','perawat','icd']),$data);
    }

    public function update(Request $request,$id)
    {
        $b= $request->berobat_id;
        $a= $request->rekammedis;
        $ubah = Medis::findorfail($id);
        $dt =[
            'berobat_id' => $request['berobat_id'],
            'tgl' => $request['tgl'],
            'umur' => $request['umur'],
            'dokter' => $request['dokter'],
            'perawat' => $request['perawat'],
            'sistolik' => $request['sistolik'],
            'diastolik' => $request['diastolik'],
            'saturasi' => $request['saturasi'],
            'suhu' => $request['suhu'],
            'tinggi' => $request['tinggi'],
            'berat' => $request['berat'],
            'napas' => $request['napas'],
            'keluhan' => $request['keluhan'],
            'tindakan' => $request['tindakan'], 
            'keterangan' => $request['keterangan'],
            'biaya' => $request['biaya'],

        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('medis/rekam_medis/berobat='.$b.'&rekammedis='.$a.'');
    }

    public function diagnosa($id)
    {   $berobat = Berobat::find($id);
        $icd = Icd::all();
        $data['title'] = 'Periksa pasien';
        return view('medis/periksa_diagnosa',compact(['berobat','icd']), $data);
    }

    public function diagnosa_store(Request $request , $id){
        $a = $request->berobat;
        $b = $request->pasien;
        $diagnosa = new Diagnosa([
            'berobat_id' => $request->berobat_id,
            'diagnosa' => $request->diagnosa,
            
        ]);
        $diagnosa->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect('medis/rekam_medis/berobat='.$a.'&rekammedis='.$b.'');
    }
    
    public function hapus_diagnosa($id){
        $diagnosa = Diagnosa::find($id);
        $diagnosa->delete();
        toast('Yeay Berhasil menghapus data','success');
        return Redirect::back();
    }

    public function obat($id,$pasien_id)
    {   $berobat = Berobat::find($id);
        $pasien = Pasien::find($pasien_id);
        
        $obat = Obat::all();
        $data['title'] = 'Periksa pasien';
        return view('medis/periksa_obat',['berobat' =>$berobat,'pasien' =>$pasien,'obat'=>$obat],$data);
    }

    public function obat_store(Request $request )
    {
        $a = $request->berobat;
        $b = $request->pasien;
        foreach ($request->addMoreInputFields as $key => $value) {
            $v = [
                'tgl'=>$value['tgl'],
                'bulan'=>$value['bulan'],
                'tahun'=>$value['tahun'],
                'berobat_id'=>$value['berobat_id'],
                'kd_obat'=>substr($value['kd_obat'],2,4),
                'jumlah'=>$value['jumlah'],
                'dosis'=>$value['dosis'],
                'pakai'=>$value['pakai'],
                'status'=>$value['status'],

            ];
            Resep::create($v);
            // dd($v);
        }
        // $ubah = Berobat::findorfail($id);
        // $dt =[
        //     'status' => $request['status'],
        // ];
        // $ubah->update($dt);
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect('medis/rekam_medis/berobat='.$a.'&rekammedis='.$b.'');
    }

    public function selesai(Request $request , $id){
        $ubah = Berobat::findorfail($id);
        $dt =[
            'status' => $request['status'],
        ];
        $ubah->update($dt);
        // $resep = Resep       
        // dd($obat);
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return Redirect::back();
    }
    public function selesai_resep(Request $request , $id,$id_pasien){
       
        $ubah = Berobat::findorfail($id);
        $dt =[
            'status' => $request['status'],
        ];
        $ubah->update($dt);
        // $resep = Resep
        $obat = Resep::where('berobat_id','=',''.$id.'');
        $dt_obat =[
            'status' => $request['status1'],
        ];
        $obat->update($dt_obat);
        // dd($obat);
        $berobat = Berobat::find($id);
        $pasien = Pasien::find($id_pasien);
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $resep = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('berobat_id','=',''.$id.'')->get();
        $pdf = PDF::loadView('medis/cetak_rm',compact('pasien','kapus','berobat','resep'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_rekam_medis.pdf');
    }

    public function hapus_resep($id){
        $resep = Resep::find($id);
        $resep->delete();
        toast('Yeay Berhasil menghapus data','success');
        return Redirect::back();
    }

    public function cetak_rm($id,$pasien_id){
        $berobat = Berobat::find($id);
        $pasien = Pasien::find($pasien_id);
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $resep = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('berobat_id','=',''.$id.'')->get();
        $pdf = PDF::loadView('medis/cetak_rm',compact('pasien','berobat','kapus','resep'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_rekam_medis.pdf');
    }
}
