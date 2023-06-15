<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PegawaiController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $pegawai = DB::table('tb_pegawai')->where('nama','like',"%".$cari."%")
        ->orWhere('nip','like',"%".$cari."%")
		->paginate(6);
 
        return view('pegawai/pegawai', ['pegawai' => $pegawai,'title' => 'Pegawai'] );
    }

    public function create()
    {
        $data['title'] = 'Tambah Pegawai';
        return view('pegawai/tambah_pegawai', $data);
    }

    public function store(Request $request)
    {

        $pegawai = new Pegawai([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'alamat' => $request->alamat,
            'jns_kelamin' => $request->jns_kelamin,
            'kelompok' => $request->kelompok,
            'spesialis' => $request->spesialis,
        ]);
        $pegawai->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('pegawai/pegawai');
    }

    public function editpegawai($id){
        $pegawai = Pegawai::find($id);
        $data['title'] = 'Edit Pegawai';
        return view('pegawai.edit_pegawai',compact(['pegawai']),$data);
    }

    public function updatepegawai(Request $request, $id){
        $ubah = Pegawai::findorfail($id);
        $dt =[
            'nip' => $request['nip'],
            'nama' => $request['nama'],
            'tanggal' => $request['tanggal'],
            'tempat' => $request['tempat'],
            'alamat' => $request['alamat'],
            'jns_kelamin' => $request['jns_kelamin'],
            'kelompok' => $request['kelompok'],
            'spesialis' => $request['spesialis'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('pegawai/pegawai');
    }
    
    public function destroy($id){
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('pegawai/pegawai');
    }

    public function cetak_pegawai(Request $request)
    {   $tgl = $request->tgl;
        $cari = $request->cari;
        $pegawai = DB::table('tb_pegawai')->where('nama','LIKE',"%".$cari."%")->get();
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $pdf = PDF::loadView('pegawai/cetak',compact('pegawai','tgl','kapus'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_pegawai.pdf');
    }

    public function laporan(Request $request)
	{   $cari = $request->cari;
        $pegawai = DB::table('tb_pegawai')->where('nama','like',"%".$cari."%",'')
		->paginate(7);
 
        return view('laporan/pegawai', ['pegawai' => $pegawai,'title' => 'Laporan Pegawai'] );
    }

}
