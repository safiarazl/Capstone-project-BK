<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use App\Models\Jadwal_periksa;
use Illuminate\Support\Facades\Auth;

class DokterDashboard extends Controller
{
    // view function dokter
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function periksaPasien(){
        // $user = auth()->user();
        // $dokter = Dokter::where('id_akun', $user->id)->first();
        // $jadwal = Jadwal_periksa::where('id_dokter', $dokter->id)->get();
        // // dd($user, $dokter, $jadwal);
        return view('dokter.periksaDokter');
    }

    public function changeProfile()
    {
        $user = auth()->user();
        $dokter = Dokter::where('id_akun', $user->id)->first();
        $polis = Poli::all();
        // dd($user, $dokter);
        return view('dokter.changeProfile', compact('user', 'dokter', 'polis'));
    }

    // proses function dokter
    public function inputJadwalProses(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $user = auth()->user()->id;
        $dokter = Dokter::where('id_akun', $user)->first();
        $hari = $request->input('hari');
        $jam_mulai = $request->input('jam_mulai');
        $jam_selesai = $request->input('jam_selesai');
        // dd($dokter, $hari, $jam_mulai, $jam_selesai);
        Jadwal_periksa::create([
            'id_dokter' => (int) $dokter->id,
            'hari' => $hari,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil menambah jadwal!');
    }

    public function changeProfileProses($id, Request $request)
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

        $dokter = Dokter::where('id', $id)->first();
        $user = User::where('id', $dokter->id_akun)->first();
        // dd($request->all(), $id, $dokter, $user);
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

        return redirect()->route('dashboard')->with('success', 'Berhasil mengubah data');
    }
}
