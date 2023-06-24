<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Obatmasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatmasukController extends Controller
{
    public function create(){
        $obat = Obat::all();
        $data['title'] = 'Tambah Stok Obat';
        return view('obat.tambah_stok',compact(['obat']),$data);
    }

    public function stok_store(Request $request)
    {
        foreach ($request->addMoreInputFields as $key => $value) {
            $v = [
                'tgl'=>$value['tgl'],
                'bulan'=>$value['bulan'],
                'tahun'=>$value['tahun'],
                'no_surat'=>$value['no_surat'],
                'kode'=>substr($value['kode'],0,6),
                'jumlah'=>$value['jumlah'],
                'penerima'=>$value['penerima'],

            ];
            Obatmasuk::create($v);
            // dd($v);
        }
        // $tobat = new Obatmasuk([
        //     'kode' => $request->kode,
        //     'nama_obat' => $request->nama_obat,
        //     'jumlah' => $request->jumlah,
        //     'tgl' => $request->tgl,
        //     'bulan' => $request->bulan,
        //     'tahun' => $request->tahun,

        // ]);
        // $tobat->save();
        
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('obat/obat');
    }

    public function editstok($id){
        $obat = DB::table('tb_obatmasuk')->where('tb_obatmasuk.id','=',''.$id.'')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')
        ->select('tb_obatmasuk.kode','no_surat','tb_obatmasuk.id','jumlah','penerima','tgl','bulan','tahun','nm_obat')->get();
        // dd($obat);
        $data['title'] = 'Edit Obat';
        return view('obat.edit_stok',compact(['obat']),$data);
    }
    public function updatestok(Request $request, $id){
        $ubah = Obatmasuk::findorfail($id);
        $dt =[
            'kode' => $request['kode'],
            'no_surat' => $request['no_surat'],
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
