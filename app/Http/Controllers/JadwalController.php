<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $tgl = $request->tgl;
        $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('tgl','=',''.$tgl.'')
        ->paginate(6);
        return view('petugas/petugas', ['jadwal'=>$jadwal,'title' => 'Petugas'] );
    }

    public function create($id){
        $jadwal = Petugas::find($id);
        $data['title'] = 'Tambah Jadwal Jaga';
        return view('petugas/jaga', compact(['jadwal']),$data);
    }

    public function store(Request $request){
        $jadwal = new Jadwal([
            'petugas_id' => $request->petugas_id,
            'tgl' => $request->tgl,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => $request->status,
        ]);
        $jadwal->save();
        Alert()->success('SuccessAlert','Tambah data pegawai berhasil');
        return redirect('petugas/petugas?tgl='.date('d-m-Y').'');
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
        return redirect('petugas/petugas?tgl='.date('d-m-Y').'');
    }
    
    public function laporan_jadwal(Request $request){
        $tgl = $request->tgl;
        $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('tgl','=',''.$tgl.'')
        ->paginate(6);
        return view('laporan/jadwal', ['jadwal'=>$jadwal,'title' => 'Jadwal Petugas'] );
    }

    public function cetak_jadwal(Request $request){
        $tgl = $request->tgl;
        $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')
        ->where('tgl','=',''.$tgl.'')->get();
        $pdf = PDF::loadView('petugas/cetak_jadwal',compact('jadwal'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('Cetak_jadwal_petugas.pdf');
    }
}
