<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Obatmasuk;
use Illuminate\Http\Request;

class ObatmasukController extends Controller
{
    public function create($kode){
        $obat = Obat::find($kode);
        $data['title'] = 'Tambah Stok Obat';
        return view('obat.tambah_stok',compact(['obat']),$data);
    }

    public function stok_store(Request $request)
    {

        $tobat = new Obatmasuk([
            'kode' => $request->kode,
            'nama_obat' => $request->nama_obat,
            'jumlah' => $request->jumlah,
            'tgl' => $request->tgl,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,

        ]);
        $tobat->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('obat/obat');
    }

    public function editstok($id){
        $obat = Obatmasuk::find($id);
        $data['title'] = 'Edit Obat';
        return view('obat.edit_stok',compact(['obat']),$data);
    }
    public function updatestok(Request $request, $id){
        $ubah = Obatmasuk::findorfail($id);
        $dt =[
            'kode' => $request['kode'],
            'nama_obat' => $request['nama_obat'],
            'jumlah' => $request['jumlah'],
            'tgl' => $request['tgl'],
            'bulan' => $request['bulan'],
            'tahun' => $request['tahun'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('obat/masuk');
    }
    public function destroy($id){
        $obat = Obatmasuk::find($id);
        $obat->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect()->back();
    }
}
