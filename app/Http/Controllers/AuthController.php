<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 'admin') {
                return redirect()->intended('admin?tgl='.date('d-m-Y').'');
            } elseif ($user->level == 'rekam_medis') {
                return redirect()->intended('rekam_medis?tgl='.date('d-m-Y').'');
            }elseif ($user->level == 'apotek') {
                return redirect()->intended('apotek?tgl='.date('d-m-Y').'');
            }elseif ($user->level == 'kapus') {
                return redirect()->intended('kapus?tgl='.date('d-m-Y').'');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('username','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                if ($user->email_verified_at == null) {
                    return redirect()->intended('verifikasi');
                } else{
                    if ($user->level == 'admin') {
                        return redirect()->intended('admin?tgl='.date('d-m-Y').'');
                    } elseif ($user->level == 'rekam_medis') {
                        return redirect()->intended('rekam_medis?tgl='.date('d-m-Y').'');
                    }elseif ($user->level == 'apotek') {
                        return redirect()->intended('apotek?tgl='.date('d-m-Y').'');
                    }elseif ($user->level == 'kapus') {
                        return redirect()->intended('kapus?tgl='.date('d-m-Y').'');
                    }
                }
                return redirect()->intended('/');
            }

        return redirect('login')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'PASSWORD SALAH']);
    }

    public function register()
    {
        return view('register');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' =>$request->level,
        ]);
        $user->save();

        event(new Registered($user));
        auth()->login($user);

        return redirect()->route('verifikasi')->with('success', 'Registration success. Silahkan verifikasi email anda');
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
    }
    
    public function verifikasi(){
        return view('verifikasi');
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        if($email == ''){
            $user = DB::table('users')->where('email','=','')->get();
        }else if($email == $email){
            $user = DB::table('users')->where('email','=',''.$email.'')->get();
        }
        
        return view('lupa', ['u' => $user]);
    }
    public function resetpassword(Request $request, $id){
        $ubah = User::findorfail($id);
        $dt =[
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'email_verified_at' => $request['email_verified_at'],
            'password' => Hash::make ($request['password']),
            'level' => $request['level'],
            'remember_token' => $request['remember_token'],
        ];
        $ubah->update($dt);
        alert('Sukses','Simpan Data Berhasil', 'success');
        return redirect('login');
    }
}
