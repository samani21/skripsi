<?php

namespace App\Http\Controllers;

use App\Models\Berobat;
use App\Models\Biaya;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class BerobatController extends Controller
{
    public function index(Request $request)
	{   
        $cari = $request->cari;
        $poli = $request->poli;
        if($cari == ""){
            $berobat = DB::table('tb_berobat')->join('tb_pasien','tb_pasien.id_pasien','=','tb_berobat.pasien_id')
            ->where('poli','like',"%".$poli."%")
            ->paginate(7);
        }else if($cari == $cari){
            $berobat = DB::table('tb_berobat')->join('tb_pasien','tb_pasien.id_pasien','=','tb_berobat.pasien_id')
            ->where('tgl','like',"%".$cari."%")
            ->orWhere('nama','like',"%".$cari."%")
            ->orWhere('tb_berobat.no_berobat','=',"".$cari."")
            ->orWhere('tb_berobat.nik','=',"".$cari."")
            // ->where('poli','like',"%".$poli."%")
            ->paginate(7);
        }

       
        return view('medis/medis', ['berobat' => $berobat,'title' => 'Rekam medis'] );
    }

    public function create($id)
    {   $pasien = Pasien::find($id);
        $data['title'] = 'Tambah berobat';
        return view('pasien/daftar',compact(['pasien']), $data);
    }
    
    
    public function store(Request $request)
    {

        $berobat = new Berobat([
            'pasien_id' => $request->pasien_id,
            'no_berobat' => $request->no_berobat,
            'nik' => $request->nik,
            'jenis_berobat' => $request->jenis_berobat,
            'bpjs' => $request->bpjs,
            'umum' => $request->umum,
            'umur' => $request->umur,
            'nama_berobat' => $request->nama_berobat,
            'poli' => $request->poli,
            'password' => $request->password,
            'tgl' => $request->tgl,
            'status' => $request->status,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        $biaya = new Biaya([
            'pasien_id' => $request->pasien_id,
            'poli' => $request->poli,
            'j_berobat' => $request->jenis_berobat,
            'biaya' => $request->umum,
        ]);
        $biaya->save();
        $berobat->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('pasien/pasien');
    }

    public function laporan(Request $request)
	{   $tgl = $request->tgl;
        $berobat = DB::table('tb_berobat')->where('tgl','like',"%".$tgl."%")
        ->orWhere('tahun','like',"%".$tgl."%")
        ->orWhere('bulan','like',"%".$tgl."%")
		->paginate(7);
 
        return view('laporan/medis', ['berobat' => $berobat,'title' => 'Laporan Berobat'] );
    }

    public function cetak_medis(Request $request)
    {   $tgl = $request->tgl;
        $medis = DB::table('tb_berobat')->where('tgl','like',"%".$tgl."%")
        ->orWhere('tahun','like',"%".$tgl."%")
        ->orWhere('bulan','like',"%".$tgl."%")
		->paginate();
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $pdf = PDF::loadView('medis/cetak_medis',compact('medis','tgl','kapus'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_medis.pdf');
    }
}
