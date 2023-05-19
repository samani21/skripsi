<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    public function index(Request $request)
	{   $cari = $request->cari;
        $obat = DB::table('tb_obat')->where('nm_obat','like',"%".$cari."%",'')->paginate(7);
 
        return view('obat/obat', ['obat' => $obat,'title' => 'Obat'] );
    }

    public function create()
    {
        $data['title'] = 'Tambah Obat';
        return view('obat/tambah_obat', $data);
    }

    public function store(Request $request)
    {

        $obat = new Obat([
            'nm_obat' => $request->nm_obat,
            'stok' => $request->stok,
        ]);
        $obat->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('obat/obat');
    }

    public function editobat($kode){
        $obat = Obat::find($kode);
        $data['title'] = 'Edit Obat';
        return view('obat.edit_obat',compact(['obat']),$data);
    }

    public function updateobat(Request $request, $kode){
        $ubah = Obat::findorfail($kode);
        $dt =[
            'nm_obat' => $request['nm_obat'],
            'stok' => $request['stok'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('obat/obat');
    }
    public function destroy($id){
        $obat = Obat::find($id);
        $obat->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('obat/obat');
    }
}
