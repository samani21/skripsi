<?php

namespace App\Http\Controllers;

use App\Models\Kpuskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class KpusController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $kapus = DB::table('tb_kapus')->where('nama','like',"%".$cari."%")
        ->orWhere('nip','like',"%".$cari."%")
        ->orderBy('status','desc')->paginate(10);
        return view('kapuskes/kapuskes',['kapus' => $kapus,'title' => 'Kepala Puskesmas']);
    }

    public function create(){
        $data['title'] = "Tambah Kapus";
        return view('kapuskes/tambah_kapus',$data);
    }

    public function store(Request $request){
        $kapus = new Kpuskesmas([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'status' => $request->status,
        ]);
        $kapus->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('kapuskes/kapuskes');
    }

    public function editkapus($id){
        $kapus = Kpuskesmas::find($id);
        $data['title'] = 'Edit Kapus';
        return view('kapuskes.edit_kapus',compact(['kapus']),$data);
    }

    public function updatekapus(Request $request, $id){
        $ubah = Kpuskesmas::findorfail($id);
        $dt =[
            'nip' => $request['nip'],
            'nama' => $request['nama'],
            'tgl_mulai' => $request['tgl_mulai'],
            'tgl_selesai' => $request['tgl_selesai'],
            'status' => $request['status'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('kapuskes/kapuskes');
    }
    
    public function destroy($id){
        $kapus = Kpuskesmas::find($id);
        $kapus->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('kapuskes/kapuskes');
    }
    public function selesai(Request $request, $id){
        $kapus = Kpuskesmas::find($id);
        $data['title'] = 'Selesai Jabatan Kapus';
        return view('kapuskes.selesai_kapus',compact(['kapus']),$data);
    }

    public function updateselesai(Request $request, $id){
        $ubah = Kpuskesmas::findorfail($id);
        $dt =[
            'nip' => $request['nip'],
            'nama' => $request['nama'],
            'tgl_mulai' => $request['tgl_mulai'],
            'tgl_selesai' => $request['tgl_selesai'],
            'status' => $request['status'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('kapuskes/kapuskes');
    }

    public function cetak_kapus(Request $request)
    {   $tgl = $request->tgl;
        $cari = $request->cari;
        $kapus = DB::table('tb_kapus')->where('nama','LIKE',"%".$cari."%")->get();
        $kapu = DB::table('tb_kapus')->where('status','=','1')->paginate(1);
        $pdf = PDF::loadView('kapuskes/cetak',compact('tgl','kapus','kapu'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_pegawai.pdf');
    }

    public function laporan(Request $request)
	{   $cari = $request->cari;
        $kapus = DB::table('tb_kapus')->where('nama','like',"%".$cari."%",'')
		->paginate(7);
 
        return view('laporan/kapus', ['kapus' => $kapus,'title' => 'Laporan Kapus'] );
    }
}
