<?php

namespace App\Http\Controllers;

use App\Models\daftar_poli;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienDashboard extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function daftarPoliProses(Request $request)
    {
        $request->validate([
            'jadwal' => 'required',
            'keluhan' => 'required',
        ]);

        $user = auth()->user()->id;
        $pasien = Pasien::where('id_akun', $user)->first();
        $jadwal = $request->input('jadwal');
        $keluhan = $request->input('keluhan');

        daftar_poli::create([
            'id_pasien' => (int) $pasien->id,
            'id_jadwal' => (int) $jadwal,
            'keluhan' => $keluhan,
            'no_antrian' => (int) $this->generateNoAntrian($jadwal),
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar poli!');
    }

    protected function generateNoAntrian($jadwal)
    {
        $daftar_poli = daftar_poli::where('id_jadwal', $jadwal)->get();
        $no_antrian = count($daftar_poli) + 1;
        return $no_antrian;
    }
}
