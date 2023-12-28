<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dokter; // Add this line to import the 'Dokter' class
use App\Models\User; // Add this line to import the 'User' class
use App\Models\Poli;

class AdminDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if (session('role') != 'admin') {
            redirect('/login')->with('error', 'You do not have access to this page!');
        }
    }
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function manageDokter()
    {
        $dokters = Dokter::with(['user', 'poli'])->get();
        return view('dashboard.manageDokter', compact('dokters'));
    }

    public function editDokter($id)
    {
        $dokter = Dokter::with(['user', 'poli'])->where('id', $id)->first();
        // dd($dokter);
        $polis = Poli::all();
        return view('dashboard.editDokter', compact('dokter', "polis"));
    }

    public function tambahDokter()
    {
        $polis = Poli::all();
        return view('dashboard.tambahDokter', compact('polis'));
    }

    public function deleteDokterProses($id)
    {
        $dokter = Dokter::find($id)->first();
        $user = User::where('id', $dokter->id_akun)->first();
        $dokter->delete();
        $user->delete();
        return redirect('/manage-dokter')->with('success', 'Dokter deleted successfully!');
    }

    public function tambahDokterProses(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:2',
        ]);

        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'id_akun' => $user->id,
            'id_poli' => $request->input('id_poli'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect('/manage-dokter')->with('success', 'Dokter added successfully!');
    }

    public function editDokterProses($id, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required',
            'email' => 'required|email',
            'password-lama' => 'required|min:2',
            'password-baru' => 'required|min:2',
        ]);

        $dokter = Dokter::find($id)->first();
        $user = User::where('id', $dokter->id_akun)->first();

        if (!password_verify($request->input('password-lama'), $user->password)) {
            return back()->withErrors(['password-lama' => 'Password lama tidak sama!'])->withInput();
        }

        $dokter->update([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'id_poli' => $request->input('id_poli'),
        ]);

        $user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password-baru'),
        ]);

        return redirect('/manage-dokter')->with('success', 'Dokter updated successfully!');
    }
}
