<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index(){
        $jadwal = DB::table('tb_jadwal')->join('tb_petugas','tb_petugas.id','=','tb_jadwal.petugas_id')->paginate(6);
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
        return redirect()->route('petugas/petugas');
    }

    public function selesai($id_jadwal){
        $jadwal = Jadwal::find($id_jadwal);
        $data['title'] = 'Edit Pegawai';
        return view('petugas.selesai',compact(['jadwal']),$data);
    }

    public function selesai_jaga(Request $request, $id){
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
        return redirect('petugas/petugas');
    }
}
