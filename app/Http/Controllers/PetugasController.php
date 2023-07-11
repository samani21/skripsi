<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PetugasController extends Controller
{

    // public function index(Request $request){
    //     // $nama = $request->nama;
    //     // $petugas = DB::table('tb_petugas')->where('nama','like',"%".$nama."%",'')
	// 	// ->paginate(6);
 
    //     return view('petugas/petugas', ['title' => 'Petugas'] );
    // }

    public function data_dokter(Request $request){
        $nama = $request->nama;
        $petugas = DB::table('tb_petugas')->where('kelompok','=',"Dokter")->where('nama','like',"%".$nama."%")
        // ->orWhere('nip','like',"%".$nama."%")
		->paginate(6);
 
        return view('petugas/dokter', ['petugas' => $petugas,'title' => 'Dokter'] );
    }

    public function data_perawat(Request $request){
        $nama = $request->nama;
        $petugas = DB::table('tb_petugas')->where('kelompok','=',"Perawat")->where('nama','like',"%".$nama."%")
		->paginate(6);
 
        return view('petugas/perawat', ['petugas' => $petugas,'title' => 'Perawat'] );
    }

    public function dokter()
    {
        $data['title'] = 'Tambah Dokter';
        return view('petugas/tambah_dokter', $data);
    }

    public function perawat()
    {
        $data['title'] = 'Tambah Perawat';
        return view('petugas/tambah_perawat', $data);
    }

    public function store(Request $request)
    {
        
        $petugas = new Petugas([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'kelompok' => $request->kelompok,
            'spesialis' => $request->spesialis,
            'poli' => $request->poli,
            'id_user' => Auth::user()->id
        ]);
        $id = Auth::user()->id;
        $petugas->save();
        $edit = User::findorfail($id);
        $dt =[
            'status' => "1",
        ];
        $edit->update($dt);
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect('petugas/petugas?tgl='.date('Y-m-d').'');
    }

    public function editdokter($id){
        $dokter = Petugas::find($id);
        $data['title'] = 'Edit Dokter';
        return view('petugas.edit_dokter',compact(['dokter']),$data);
    }

    public function editperawat($id){
        $perawat = Petugas::find($id);
        $data['title'] = 'Edit Perawat';
        return view('petugas.edit_perawat',compact(['perawat']),$data);
    }

    public function updatepetugas(Request $request, $id){
        $ubah = Petugas::findorfail($id);
        $dt =[
            'nip' => $request['nip'],
            'nama' => $request['nama'],
            'kelompok' => $request['kelompok'],
            'spesialis' => $request['spesialis'],
            'poli' => $request['poli'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('petugas/petugas?tgl='.date('Y-m-d').'');
    }
    
    public function destroy($id){
        $petugas = Petugas::find($id);
        $petugas->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('petugas/petugas?tgl='.date('d-m-Y').'');
    }

    public function cetak_petugas(Request $request)
    {   
        $cari = $request->cari;
        $petugas = DB::table('tb_petugas')->where('nama','like',"%".$cari."%")->orWhere('nip','like',"%".$cari."%")
        ->orWhere('kelompok','like',"%".$cari."%")
        ->orWhere('poli','like',"%".$cari."%")->get();
        $tgl = $request->tgl;
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $pdf = PDF::loadView('petugas/cetak',compact('petugas','kapus','tgl'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('Cetak_petugas.pdf');
    }

    public function laporan(Request $request)
	{   $cari = $request->cari;
        $petugas = DB::table('tb_petugas')->where('nama','like',"%".$cari."%")->orWhere('nip','like',"%".$cari."%")
        ->orWhere('kelompok','like',"%".$cari."%")
        ->orWhere('poli','like',"%".$cari."%")
		->paginate(7);
 
        return view('laporan/petugas', ['petugas' => $petugas,'title' => 'Laporan Petugas'] );
    }
}
