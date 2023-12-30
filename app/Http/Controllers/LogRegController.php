<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LogRegController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function loginProses(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:2',
        ]);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            // Simpan informasi akun ke dalam session
            $akun = User::where('email', $request->input('email'))->first();
            $request->session()->put('name', $akun->name);
            $request->session()->put('role', $akun->role);
            return redirect('/home')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful!');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        // dd($request->all());
        $this->validator($request->all())->validate();

        $data = [
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'pasien',
        ];

        $user = User::create($data);

        Pasien::create([
            'id_akun' => $user->id,
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'no_hp' => $request->input('no_hp'),
            'no_rm' => $this->generateNoRM(),
        ]);

        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];


        if (Auth::attempt($login)) {
            // Simpan informasi akun ke dalam session
            $akun = User::where('email', $request->input('email'))->first();
            $request->session()->put('name', $akun->name);
            $request->session()->put('role', $akun->role);
            return redirect('/home')->with('success', 'Login successful!');
        }

        return redirect('/login')->with('success', 'Login successful!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:2',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
        ]);
    }

    protected function generateNoRM()
    {
        $year = date('Y'); // Get the current year
        $month = date('m'); // Get the current month
        $all_patients = Pasien::count();
        $no_rm = $year . $month . '-' . ($all_patients + 1); // Generate the no_rm
        return $no_rm;
    }
}
