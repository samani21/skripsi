<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PasienController extends Controller
{
    public function index(Request $request)
	{   $cari = $request->cari;
        $jenis = $request->jenis;
        $pasien = DB::table('tb_pasien')
        ->where('jenis_berobat','=',''.$jenis.'')
        ->where('nama','like',"%".$cari."%")
		->paginate(7);
        $p_bpjs = DB::table('tb_pasien')->where('jenis_berobat','=','BPJS');
        $p_umum = DB::table('tb_pasien')->where('jenis_berobat','=','Umum');

        if(Auth::user()->level == 'admin'){
            $pasien = DB::table('tb_pasien')
            ->where('jenis_berobat','=',''.$jenis.'')
            ->where('nama','like',"%".$cari."%")
            ->orWhere('no_berobat','=',''.$cari.'')
            ->orWhere('nik','=',''.$cari.'')
            ->paginate(7);
            $total = DB::table('tb_pasien')->where('jenis_berobat','=',''.$jenis.'');
            return view('pasien/pasien', ['pasien' => $pasien,'title' => 'Pasien','jenis'=>$jenis,'total'=>$total] );
        }
        if(Auth::user()->level == 'operator'){
            $pasien = DB::table('tb_pasien')
            ->where('nama','like',"%".$cari."%")
            ->orWhere('no_berobat','=',"%".$cari."%")
            ->orWhere('nik','like',"%".$cari."%")
		    ->paginate(7);
            $p_bpjs = DB::table('tb_pasien')->where('jenis_berobat','=','BPJS');
            $p_umum = DB::table('tb_pasien')->where('jenis_berobat','=','Umum');
            return view('pasien/pasien', ['pasien' => $pasien,'p_bpjs'=>$p_bpjs,'p_umum'=>$p_umum,'title' => 'Pasien'] );
        }
        
    }

    public function create()
    {
        $cek = Pasien::count();
        if($cek == 0 ){
            $urut = 1;
            $nomor = 'P000'.$urut;
        }else{
            $ambil = Pasien::all()->last();
            $urut = (int)substr($ambil->id_pasien, 0)+1;
            $nomor = $urut; 
        }
        $data['title'] = 'Tambah Pasien';
        return view('pasien/tambah_pasien',compact(['nomor']),$data);
    }

    public function store(Request $request)
    {

        $pasien = new Pasien([
            'no_berobat' => $request->no_berobat,
            'nik' => $request->nik,
            'jenis_berobat' => $request->jenis_berobat,
            'no_bpjs' => $request->no_bpjs,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'jk' => $request->jk,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'gol_darah' => $request->gol_darah,
            'no_hp' => $request->no_hp,
            'tgl_pasien' => $request->tgl_pasien,
            'bulan_pasien' => $request->bulan_pasien,
            'tahun_pasien' => $request->tahun_pasien,
            'password' => $request->password,
        ]);
        $pasien->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect()->route('pasien/pasien');
    }

    public function editpasien($id){
        $pasien = Pasien::find($id);
        $data['title'] = 'Edit Pasien';
        return view('pasien.edit_pasien',compact(['pasien']),$data);
    }

    public function updatepasien(Request $request, $id){
        $ubah = Pasien::findorfail($id);
        $dt =[
            'no_berobat' => $request['no_berobat'],
            'nik' => $request['nik'],
            'jenis_berobat' => $request['jenis_berobat'],
            'no_bpjs' => $request['no_bpjs'],
            'nama' => $request['nama'],
            'tanggal' => $request['tanggal'],
            'jk' => $request['jk'],
            'tempat' => $request['tempat'],
            'kota' => $request['kota'],
            'alamat' => $request['alamat'],
            'gol_darah' => $request['gol_darah'],
            'no_hp' => $request['no_hp'],
            'tgl_pasien' => $request['tgl_pasien'],
            'bulan_pasien' => $request['bulan_pasien'],
            'tahun_pasien' => $request['tahun_pasien'],
            'password' => $request['password'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('pasien/pasien');
    }

    public function destroy($id){
        $pasien = Pasien::find($id);
        $pasien->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('pasien/pasien');
    }

    public function detail($id,$pasien_id){
        $pasien = Pasien::find($id);
        $berobat = DB::table('tb_berobat')->where('pasien_id','=',''.$pasien_id.'')->paginate(10);
        $data['title'] = 'Data Pasien';
        return view('pasien.detail',['berobat' =>$berobat,'pasien' =>$pasien],$data);
    }

    public function cetak_pasien(Request $request)
    {
        $tgl = $request->tgl;
        $cari = $request->cari;
        $dari = $request->dari;
        $sampai = $request->sampai;
        if($cari = $cari){
            $pasien = DB::table('tb_pasien')
            ->where('nama','like',"%".$cari."%")
            ->orWhere('nik','like',"%".$cari."%")
            ->get();
            $p_bpjs = DB::table('tb_pasien')
            ->where('nama','like',"%".$cari."%")
            ->orWhere('nik','like',"%".$cari."%")
            ->where('jenis_berobat','=','BPJS');
            $p_umum = DB::table('tb_pasien')
            ->where('nama','like',"%".$cari."%")
            ->orWhere('nik','like',"%".$cari."%")
            ->where('jenis_berobat','=','Umum');
        }else{
            $pasien = DB::table('tb_pasien')
            ->whereBetween('tgl_pasien',[$dari,$sampai])
            ->get();
            $p_bpjs = DB::table('tb_pasien')
            ->whereBetween('tgl_pasien',[$dari,$sampai])->where('jenis_berobat','=','BPJS');
            $p_umum = DB::table('tb_pasien')
            ->whereBetween('tgl_pasien',[$dari,$sampai])->where('jenis_berobat','=','Umum');
        }
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        $pdf = PDF::loadView('pasien/cetak_pasien',compact('pasien','tgl','kapus','p_bpjs','p_umum','dari','sampai'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_pasien.pdf');
    }
    public function laporan(Request $request)
	{   
        $cari = $request->cari;
        $pasien = DB::table('tb_pasien')->where('nama','like',"%".$cari."%")->orWhere('no_berobat','=',"".$cari."")->orWhere('nik','like',"%".$cari."%")
		->paginate(7);
        $p_bpjs = DB::table('tb_pasien')->where('jenis_berobat','=','BPJS');
        $p_umum = DB::table('tb_pasien')->where('jenis_berobat','=','Umum');
        return view('laporan/pasien', ['p_bpjs'=>$p_bpjs,'p_umum'=>$p_umum,'pasien' => $pasien,'title' => 'Laporan pasien'] );
    }

    public function cetak_kartu($id)
    {   
        $kartu = Pasien::find($id);
        $pdf = PDF::loadView('pasien/cetak_kartu',compact('kartu'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_kartu.pdf');
    }
}
