<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuController extends Controller
{
    public function index (Request $request){
        $cari = $request->cari;
        $kartu = DB::table('tb_kartu')->where('nama','like',"%".$cari."%",'')
		->paginate(6);
 
        return view('kartu/kartu', ['kartu' => $kartu,'title' => 'Kartu Berobat'] );
    }

    public function create()
    {
        $cek = Kartu::count();
        if($cek == 0 ){
            $urut = 1;
            $nomor = $urut;
        }else{
            $ambil = Kartu::all()->last();
            $urut = (int)substr($ambil->no, -1)+1;
            $nomor = $urut;
        }
        $data['title'] = 'Tambah Kartu Berobat';
        return view('kartu/tambah_kartu',compact(['nomor']), $data);
    }

    public function store(Request $request)
    {

        $pegawai = new Kartu([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl' => $request->tgl,
            'tempat' => $request->tempat,
            'jk' => $request->jk,
        ]);
        $pegawai->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('kartu/kartu');
    }

    public function editkartu($id){
        $kartu = Kartu::find($id);
        $data['title'] = 'Edit Pegawai';
        return view('kartu.edit_kartu',compact(['kartu']),$data);
    }

    public function updatekartu(Request $request, $id){
        $ubah = Kartu::findorfail($id);
        $dt =[
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl' => $request->tgl,
            'tempat' => $request->tempat,
            'jk' => $request->jk,
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('kartu/kartu');
    }
    
    public function destroy($id){
        $kartu = Kartu::find($id);
        $kartu->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('kartu/kartu');
    }
}
