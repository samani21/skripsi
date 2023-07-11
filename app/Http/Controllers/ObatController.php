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
	{   
        $cari = $request->cari;
        $obat = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')
        ->select('tb_obatmasuk.id as id','no_surat','tb_obatmasuk.kode','nm_obat','jumlah','tgl','penerima')
        ->where('nm_obat','like',"%".$cari."%")
        ->orWhere('tgl','like',"%".$cari."%")
        ->orWhere('no_surat','like',"%".$cari."%")
        ->orWhere('penerima','like',"%".$cari."%")
        ->paginate(10);
        $obat->withPath('masuk?tgl=14-01-2023&');
        return view('obat/masuk', ['obat' => $obat,'title' => 'Obat Masuk'] );
    }

    public function keluar(Request $request)
	{   $tgl = $request->tgl;
        $cari = $request->cari;
        if($cari == ""){
            $obat = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')
            ->select('nm_obat','kd_obat',DB::raw('sum(jumlah) as jum'),'tgl')
            ->where('tgl','like',"%".$tgl."%")
            ->groupBy('nm_obat','kd_obat','tgl')->get();
        }else if($cari == $cari){
        $obat = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')
        ->select('nm_obat','kd_obat',DB::raw('sum(jumlah) as jum'),'tgl')
        ->where('nm_obat','LIKE',"%".$cari."%")
        ->orWhere('tgl','LIKE',"%".$cari."%")
        ->groupBy('nm_obat','kd_obat','tgl')->get();
        }
        return view('obat/obatkeluar', ['obat' => $obat,'title' => 'Obat'] );
    }

    public function create()
    {
        // $cek = Obat::count();
        // if($cek == 0 ){
        //     $urut = 1;
        //     $nomor = $urut;
        // }else{
        //     $ambil = Obat::all()->last();
        //     $urut = (int)substr($ambil->id, 0)+1;
        //     $nomor = $urut; 
        // }
        $data['title'] = 'Tambah Obat';
        return view('obat/tambah_obat', $data);
    }

    public function store(Request $request)
    {

        $obat = new Obat([
            'kode' => $request->kode,
            'nm_obat' => $request->nm_obat,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
        ]);
        $obat->save();
        Alert()->success('SuccessAlert','Tambah data obat berhasil');
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
            'satuan' => $request['satuan'],
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
        $obat = DB::table('tb_obat')->where('nm_obat','like',"%".$cari."%")
        ->orWhere('stok','like',"%".$cari."%",'')
        ->get();
        $pdf = PDF::loadView('obat/cetak_obat',compact('obat','kapus','tgl'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obat.pdf');;
    }

    public function laporan(Request $request)
	{   $cari = $request->cari;
        $obat = DB::table('tb_obat')->where('nm_obat','like',"%".$cari."%")
        ->orWhere('stok','like',"%".$cari."%")
		->paginate(7);
 
        return view('laporan/obat', ['obat' => $obat,'title' => 'Laporan Obat'] );
    }

    public function laporan_masuk(Request $request)
	{   $tgl = $request->tgl;
        $cari = $request->cari;
        if($cari == ""){
            $masuk = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')->where('tgl','like',"%".$tgl."%")
            ->paginate(7);
        }else if($cari == $cari){
            $masuk = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')->where('tgl','like',"%".$cari."%")
            ->orWhere('nm_obat','like',"%".$cari."%")
            ->paginate(7);
        }
        $masuk->withPath('obat_masuk?tgl='.date('d-m-Y').'&');
        return view('laporan/obat_masuk', ['masuk' => $masuk,'title' => 'Laporan obat masuk'] );
    }

    public function laporan_keluar(Request $request)
	{   $tgl = $request->tgl;
        $cari = $request->cari;
        if($cari == ""){
            $keluar = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('tgl','like',"%".$tgl."%")
            ->paginate(7);
        }else if($cari == $cari){
            $keluar = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('tgl','like',"%".$cari."%")
            ->orWhere('nm_obat','like',"%".$cari."%")
            ->paginate(7);
        }
        $keluar->withPath('obat_keluar?tgl='.date('d-m-Y').'&');
        return view('laporan/obat_keluar', ['keluar' => $keluar,'title' => 'Laporan obat keluar'] );
    }

    public function cetak_obatmasuk(Request $request)
    {   $tgl = $request->tgl;
        $cari = $request->cari;
        $dari = $request->dari;
        $sampai = $request->sampai;
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
       if($cari = $cari){
        $masuk = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')
        ->orWhere('nm_obat','like',"%".$cari."%")
        ->paginate();
        

        $total = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')
        ->orWhere('nm_obat','like',"%".$cari."%")
        ->select('nm_obat','stok')
        ->groupBy('nm_obat','stok')
        ->paginate();
       }else{
        $masuk = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')
        ->whereBetween('tgl',[$dari,$sampai])
        ->paginate();
        $total = DB::table('tb_obatmasuk')->join('tb_obat','tb_obat.kode','=','tb_obatmasuk.kode')
        ->whereBetween('tgl',[$dari,$sampai])
        ->select('nm_obat','stok')
        ->groupBy('nm_obat','stok')
        ->paginate();
       }
        $pdf = PDF::loadView('obat/cetak_obatmasuk',compact('masuk','tgl','kapus','total'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obatmasuk.pdf');
    }

    public function cetak_obatkeluar(Request $request)
    {   $tgl = $request->tgl;
        $cari = $request->cari;
        $dari = $request->dari; 
        $sampai = $request->sampai; 
        if($cari = $cari){
            $keluar = DB::table('tb_resep')
            ->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')
            ->where('tgl','like',"%".$cari."%")
            ->orWhere('nm_obat','like',"%".$cari."%")
            ->get();
            $total = DB::table('tb_resep')->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')->where('tgl','like',"%".$cari."%")
            ->orWhere('nm_obat','like',"%".$cari."%")
            ->select('nm_obat','stok')
            ->groupBy('nm_obat','stok')
            ->paginate();
        }else{
            $keluar = DB::table('tb_resep')
            ->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')
            ->whereBetween('tgl',[$dari,$sampai])
            ->get();
            $total = DB::table('tb_resep')
            ->join('tb_obat','tb_obat.kode','=','tb_resep.kd_obat')
            ->whereBetween('tgl',[$dari,$sampai])
            ->select('nm_obat','stok')
            ->groupBy('nm_obat','stok')
            ->paginate();
        }
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $pdf = PDF::loadView('obat/cetak_obatkeluar',compact('keluar','tgl','kapus','total'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_obatkeluar.pdf');
    }
}
