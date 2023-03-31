<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index(Request $request){
        $nama = $request->nama;
        $petugas = DB::table('tb_petugas')->where('nama','like',"%".$nama."%",'')
		->paginate(6);
 
        return view('petugas/petugas', ['petugas' => $petugas,'title' => 'Petugas'] );
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
        ]);
        $petugas->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('petugas/petugas');
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
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('petugas/petugas');
    }
    
    public function destroy($id){
        $petugas = Petugas::find($id);
        $petugas->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('petugas/petugas');
    }
}
