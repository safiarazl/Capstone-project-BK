<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;

class LogRegController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function loginProses(Request $request)
    {
        // dd($request->all());
        $akun = Akun::where('email', $request->input('email'))->first();
        if ($akun->email == $request->input('email') && password_verify($request->input('password'), $akun->password)) {
            // Simpan informasi akun ke dalam session
            $request->session()->put('id', $akun->id);
            $request->session()->put('email', $akun->email);
            $request->session()->put('role', $akun->role);

            if ($akun->role == 'pasien') {
                return redirect('/pasien/dashboard')->with('success', 'Login successful!');
            } else if ($akun->role == 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Login successful!');
            } else if ($akun->role == 'dokter') {
                return redirect('/dokter/dashboard')->with('success', 'Login successful!');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
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

        $akun = Akun::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'pasien',
        ]);

        Pasien::create([
            'id_akun' => $akun->id,
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'no_hp' => $request->input('no_hp'),
            'no_rm' => $this->generateNoRM(),
        ]);

        // return redirect()->route('/login')->with('success', 'Registration successful. Please log in.');
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
