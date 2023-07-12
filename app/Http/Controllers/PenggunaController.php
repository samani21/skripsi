<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $pengguna = DB::table('users')->where('name','like',"%".$cari."%")
        ->orWhere('username','like',"%".$cari."%")
		->paginate(6);
 
        return view('pengguna/pengguna', ['pengguna' => $pengguna,'title' => 'Pengguna'] );
    }
    public function editpengguna($id){
        $pengguna = User::find($id);
        $data['title'] = 'Edit Pengguna';
        return view('pengguna.edit_pengguna',compact(['pengguna']),$data);
    }

    public function updatepengguna(Request $request, $id){
        $ubah = User::findorfail($id);
        $dt =[
            'name' => $request['name'],
            'username' => $request['username'],
            'level' => $request['level'],
            'email' => $request['email'],
        ];
        $ubah->update($dt);
        alert('Sukses','Update data Berhasil', 'success');
        return redirect('pengguna/pengguna');
    }
    
    public function destroy($id){
        $pengguna = User::find($id);
        $pengguna->delete();
        toast('Yeay Berhasil menghapus data','success');
        return redirect('pengguna/pengguna');
    }
}
