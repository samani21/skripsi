<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $tgl = $request->tgl;
        $id = Auth::user()->id;
        $petugas = DB::table('tb_petugas')->where('id_user','=',''.$id.'')->paginate(1);
        $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('tgl','=',''.$tgl.'')
        ->orderBy('tb_jadwal.id_jadwal','desc')
        ->paginate(6);
        $jadwal->withPath('petugas?tgl='.date('Y-m-d').'');
        return view('petugas/petugas', ['jadwal'=>$jadwal,'title' => 'Petugas','petugas'=>$petugas] );
    }

    public function create($id){
        $jadwal = Petugas::find($id);
        $data['title'] = 'Tambah Jadwal Jaga';
        return view('petugas/jaga', compact(['jadwal']),$data);
    }

    public function store(Request $request,){
        $id = $request->id;
        $jadwal = new Jadwal([
            'petugas_id' => $request->petugas_id,
            'tgl' => $request->tgl,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => $request->status,
            'id_user' => Auth::user()->id,
        ]);
        $jadwal->save();
        $ubah = Petugas::findorfail($id);
        $dt =[
           'tgl_absen' => $request->tgl
        ];
        $ubah->update($dt);
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect('petugas/petugas?tgl='.date('Y-m-d').'');
    }

    public function selesai($id_jadwal){
        $jadwal = Jadwal::find($id_jadwal);
        $data['title'] = 'Edit Pegawai';
        return view('petugas.selesai',compact(['jadwal']),$data);
    }

    public function updatejadwal(Request $request, $id){
        $ubah = Jadwal::findorfail($id);
        $dt =[
            'petugas_id' => $request['petugas_id'],
            'tgl' => $request['tgl'],
            'mulai' => $request['mulai'],
            'selesai' => $request['selesai'],
            'status' => $request['status'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('petugas/petugas?tgl='.date('Y-m-d').'');
    }
    
    public function laporan_jadwal(Request $request){
        $tgl = $request->tgl;
        $jadwal = DB::table('tb_jadwal')
        ->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('tgl','like',''.$tgl.'')
        ->orWhere('nama','like',''.$tgl.'')
        ->orWhere('nip','like',''.$tgl.'')
        ->paginate(6);
        $jadwal->withPath('jadwal?tgl='.$tgl.'');
        return view('laporan/jadwal', ['jadwal'=>$jadwal,'title' => 'Jadwal Petugas'] );
    }

    public function cetak_jadwal(Request $request){
        $tgl = $request->tgl;
        $cari = $request->cari;
        $dari = $request->dari;
        $sampai = $request->sampai;
        $kapus = DB::table('tb_kapus')->where('status','=','1')->get();
        if($cari = $cari){
            $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nip','like',"%".$cari."%")
        ->get();
        }else{
            $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->whereBetween('tgl',[$dari,$sampai])
        ->get();
        }
        $pdf = PDF::loadView('petugas/cetak_jadwal',compact('jadwal','tgl','kapus','dari','sampai'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('Cetak_jadwal_petugas.pdf');
    }
}
