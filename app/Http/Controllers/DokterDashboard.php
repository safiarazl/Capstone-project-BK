<?php

namespace App\Http\Controllers;

use App\Models\daftar_poli;
use App\Models\detail_periksa;
use App\Models\periksa;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use App\Models\Jadwal_periksa;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;

class DokterDashboard extends Controller
{
    // view function dokter
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function riwayatPeriksa()
    {
        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', Auth::user()->id)->first()->id;

        $periksa = [];

        $oldPasien = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('daftar_poli.status', 'selesai')
            ->where('jadwal_periksa.id_dokter', $id_dokter)
            ->select('pasien.nama', 'daftar_poli.keluhan', 'periksa.tgl_periksa', 'periksa.catatan', 'periksa.id as id_periksa', 'periksa.biaya_periksa')
            ->get();

        foreach ($oldPasien as $value) {
            $obat = Periksa::join('detail_periksa', 'periksa.id', '=', 'detail_periksa.id_periksa')
                ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
                ->join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
                ->where('daftar_poli.status', 'selesai')
                ->where('periksa.id', $value->id_periksa)
                ->select('obat.nama_obat')
                ->get();

            $periksa[] = [
                'nama' => $value->nama,
                'keluhan' => $value->keluhan,  // Fetch keluhan directly from daftar_poli
                'tgl_periksa' => $value->tgl_periksa,
                'catatan' => $value->catatan,
                'obat' => $obat,
                'biaya_periksa' => $value->biaya_periksa,
            ];
        }

        // dd($periksa, $oldPasien, $obat);

        return view('dokter.riwayatPeriksa')->with(compact('id_dokter', 'periksa'));
    }


    public function periksaPasien()
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $daftar_poli = daftar_poli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();
        $allObat = Obat::all();
        date_default_timezone_set('Asia/Jakarta');
        $today = now()->format('Y-m-d H:i:s');
        $pasienTerpilih = 'belumDipilih';
        $defaultChoosen = $daftar_poli->where('no_antrian', $daftar_poli->min('no_antrian'))->first();
        // dd($daftar_poli, $allObat, $pasienTerpilih);

        return view('dokter.periksaPasien', compact('daftar_poli', 'allObat', 'pasienTerpilih', 'today', 'defaultChoosen'));
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

    public function periksaPasienProses($id_pasien)
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $daftar_poli = daftar_poli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();

        $pasienTerpilih = $daftar_poli->where('id_pasien', $id_pasien)->where('no_antrian', $daftar_poli->where('id_pasien', $id_pasien)->min('no_antrian'))->first();
        date_default_timezone_set('Asia/Jakarta');
        $today = now()->format('Y-m-d H:i:s');
        $defaultChoosen = $daftar_poli->where('id_pasien', $id_pasien)->where('no_antrian', $daftar_poli->where('id_pasien', $id_pasien)->min('no_antrian'))->first();
        $dokter_id = Dokter::where('id_akun', Auth::user()->id)->first()->id;
        $dokter = Dokter::with([
            'jadwal_periksa.daftar_poli.pasien'
        ])->find($dokter_id);
        $id_daftar_poli = null;

        // cari daftar poli by id pasien
        foreach ($dokter->jadwal_periksa as $jadwal) {
            foreach ($jadwal->daftar_poli as $daftar) {
                if ($daftar->pasien->id == $id_pasien) {
                    $id_daftar_poli = $daftar->id;
                }
            }
        }
        // cari daftar poli by id pasien selesai

        // dd($id_daftar_poli, $id_pasien);
        $allObat = Obat::all();
        $hargaDataObat = [];
        foreach ($allObat as $obat) {
            $hargaDataObat[$obat->id] = $obat->harga;
        }
        // dd($pasienTerpilih, $daftar_poli, $allObat, $today, $defaultChoosen, $hargaDataObat);
        return view('dokter.periksaPasien', compact('pasienTerpilih', 'daftar_poli', 'allObat', 'today', 'defaultChoosen', 'hargaDataObat', 'id_daftar_poli'));
    }

    public function periksaPasienProsesInsert(Request $request)
    {
        // dd($request->toArray());
        $request->validate([
            'id_daftar_poli' => 'required',
            'pilihan_obat' => 'required',
            'catatan' => 'required',
            'biaya_periksa' => 'required',
            'tanggal_pemeriksaan' => 'required',
        ]);
        // $tambahTime = $request->input('tanggal_pemeriksaan');
        // dd($tambahTime);
        $periksa = periksa::create([
            'id_daftar_poli' => $request->input('id_daftar_poli'),
            'tgl_periksa' => $request->input('tanggal_pemeriksaan'),
            'catatan' => $request->input('catatan'),
            'biaya_periksa' => $request->input('biaya_periksa'),
        ]);

        daftar_poli::where('id', $request->input('id_daftar_poli'))->update([
            'status' => 'selesai',
        ]);

        foreach ($request->input('pilihan_obat') as $obat) {
            detail_periksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obat,
            ]);
        }
        return redirect()->route('periksaPasien')->with('success', 'Berhasil memeriksa pasien!');
    }

    public function editJadwalProses(Request $request)
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

        Jadwal_periksa::where('id_dokter', $dokter->id)->update([
            'hari' => $hari,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
        ]);
        return redirect()->back()->with('success', 'Berhasil mengubah jadwal!');
    }
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
