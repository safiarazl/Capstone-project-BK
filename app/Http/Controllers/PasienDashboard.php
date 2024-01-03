<?php

namespace App\Http\Controllers;

use App\Models\daftar_poli;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\Jadwal_periksa;

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
        $jadwalInput = $request->input('jadwal');
        $keluhan = $request->input('keluhan');

        $histDaftarPolis = daftar_poli::where('id_pasien', $pasien->id)->get();
        $jadwals = Jadwal_periksa::with(['dokter.poli'])->get();

        if ($histDaftarPolis->count() > 0) {
            foreach ($histDaftarPolis as $histDaftarPoli) {
                foreach ($jadwals as $jadwal) {
                    if ($histDaftarPoli->id_jadwal == $jadwal->id && $jadwal->id == $jadwalInput) {
                        return redirect()->route('dashboard')->with('error', 'Anda sudah mendaftar poli!');
                    }
                }
            }
        }

        daftar_poli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $jadwalInput,
            'keluhan' => $keluhan,
            'no_antrian' => $this->generateNoAntrian($jadwalInput),
            'status' => 'daftar',
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar poli!');
    }

    protected function generateNoAntrian($jadwal)
    {
        // $daftar_poli = daftar_poli::where('id_jadwal', $jadwal)->get();
        // $no_antrian = count($daftar_poli) + 1;
        $no_antrian = daftar_poli::where('id_jadwal', $jadwal)->max('no_antrian') + 1;
        return $no_antrian;
    }
}
