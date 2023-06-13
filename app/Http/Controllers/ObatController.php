<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ObatController extends Controller
{
    public function index(Request $request)
	{   $cari = $request->cari;
        $obat = DB::table('tb_obat')->where('nm_obat','like',"%".$cari."%",'')->paginate(7);
 
        return view('obat/obat', ['obat' => $obat,'title' => 'Obat'] );
    }

    public function obat_masuk(Request $request)
	{   $cari = $request->cari;
        $tgl = $request->tgl;
        $obat = DB::table('tb_obatmasuk')->where('nama_obat','like',"%".$cari."%")->where('tgl','like',"%".$tgl."%")
        ->paginate(10);
        $obat->withPath('masuk?tgl=14-01-2023&');
        return view('obat/masuk', ['obat' => $obat,'title' => 'Obat Masuk'] );
    }

    public function keluar(Request $request)
	{   $tgl = $request->tgl;
        $cari = $request->cari;
        $obat = DB::table('tb_resep')->where('tgl','LIKE',"%".$tgl."%")
                                    ->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')
                                    ->where('nm_obat','LIKE',"%".$cari."%")->get();
 
        return view('obat/obatkeluar', ['obat' => $obat,'title' => 'Obat'] );
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

    public function cetak_obat(Request $request)
	{   $cari = $request->cari;
        $tgl = $request->tgl;
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $obat = DB::table('tb_obat')->where('nm_obat','like',"%".$cari."%",'')->get();
        $pdf = PDF::loadView('obat/cetak_obat',compact('obat','kapus','tgl'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obat.pdf');;
    }

    public function laporan(Request $request)
	{   $cari = $request->cari;
        $obat = DB::table('tb_obat')->where('nm_obat','like',"%".$cari."%",'')
		->paginate(7);
 
        return view('laporan/obat', ['obat' => $obat,'title' => 'Laporan Obat'] );
    }

    public function laporan_masuk(Request $request)
	{   $tgl = $request->tgl;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $masuk = DB::table('tb_obatmasuk')->where('tgl','like',"%".$tgl."%")
        ->where('tahun','like',"%".$tahun."%")
        ->where('bulan','like',"%".$bulan."%")
		->paginate(10);
        $masuk->withPath('obat_masuk?tgl=14-01-2023&');
        return view('laporan/obat_masuk', ['masuk' => $masuk,'title' => 'Laporan obat masuk'] );
    }

    public function laporan_keluar(Request $request)
	{   $tgl = $request->tgl;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $keluar = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('tgl','like',"%".$tgl."%")
        ->where('tahun','like',"%".$tahun."%")
        ->where('bulan','like',"%".$bulan."%")
		->paginate(10);
        $keluar->withPath('obat_keluar?tgl=14-01-2023&');
        return view('laporan/obat_keluar', ['keluar' => $keluar,'title' => 'Laporan obat keluar'] );
    }

    public function cetak_obatmasuk(Request $request)
    {   $tgl = $request->tgl;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $masuk = DB::table('tb_obatmasuk')->where('tgl','like',"%".$tgl."%")
        ->where('tahun','like',"%".$tahun."%")
        ->where('bulan','like',"%".$bulan."%")
		->paginate();
        $pdf = PDF::loadView('obat/cetak_obatmasuk',compact('masuk','tgl','kapus'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obatmasuk.pdf');
    }

    public function cetak_obatkeluar(Request $request)
    {   $tgl = $request->tgl;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $keluar = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('tgl','like',"%".$tgl."%")
        ->where('tahun','like',"%".$tahun."%")
        ->where('bulan','like',"%".$bulan."%")
		->paginate();
        $pdf = PDF::loadView('obat/cetak_obatkeluar',compact('keluar','tgl','kapus'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obatkeluar.pdf');
    }
}
