<?php

namespace App\Http\Controllers;

use App\Models\daftar_poli;
use Illuminate\Http\Request;
use App\Models\Dokter; // Add this line to import the 'Dokter' class
use App\Models\User; // Add this line to import the 'User' class
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Jadwal_periksa;

class AdminDashboard extends Controller
{
    // view functions
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            // get count user
            $user = User::count('id');
            $dokter = Dokter::count('id');
            $pasien = Pasien::count('id');
            $poli = Poli::count('id');
            $obat = Obat::count('id');
            return view('dashboard.dashboard', compact('user', 'dokter', 'pasien', 'poli', 'obat'));
        } else if (auth()->user()->role == 'dokter') {
            $cekJadwal = Jadwal_periksa::where('id_dokter', auth()->user()->dokter->id)->get();
            $operation = '';
            date_default_timezone_set('Asia/Jakarta');
            $dayToday = date('l');
            $hari = [
                'Senin' => 'Monday',
                'Selasa' => 'Tuesday',
                'Rabu' => 'Wednesday',
                'Kamis' => 'Thursday',
                'Jumat' => 'Friday',
                'Sabtu' => 'Saturday',
                'Minggu' => 'Sunday',
            ];
            $keys = array_keys($hari);
            // dd($cekJadwal[0]->hari , array_search($dayToday, $hari));
            if ($cekJadwal->count() > 0 && $cekJadwal[0]->hari != array_search($dayToday, $hari)) {
                $operation = 'edit';
            } else if ($cekJadwal[0]->hari == array_search($dayToday, $hari)) {
                $operation = 'noinput';
            } else {
                $operation = 'input';
            }
            // dd($cekJadwal[0]->hari, array_search($dayToday, $hari), $operation, $cekJadwal);
            return view('dashboard.dashboard', compact('cekJadwal', 'operation', 'keys'));
        } else if (auth()->user()->role == 'pasien') {
            $jadwals = Jadwal_periksa::with(['dokter.poli'])->get();
            $pasien = Pasien::where('id_akun', auth()->user()->id)->first();
            $cekPendaftaran = daftar_poli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
                ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
                ->join('poli', 'dokter.id_poli', '=', 'poli.id')
                ->where('daftar_poli.id_pasien', $pasien->id)
                ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*')
                ->get();
            // dd($cekPendaftaran);
            return view('dashboard.dashboard', compact('jadwals', 'cekPendaftaran'));
        }

        return view('dashboard.dashboard');
    }

    // view admin obat functions
    public function manageObat()
    {
        $obats = Obat::all();
        $operation = 'noedit';
        return view('dashboard.manageObat', compact('obats', 'operation'));
    }

    public function editObat($id)
    {
        $obat = Obat::where('id', $id)->first();
        $obats = Obat::all();
        $operation = 'edit';
        return view('dashboard.manageObat', compact('obats', 'obat', 'operation'));
    }

    // view admin pasien functions
    public function managePasien()
    {
        $pasiens = Pasien::with(['user'])->get();
        $operation = 'noedit';
        return view('dashboard.managePasien', compact('pasiens', 'operation'));
    }

    public function editPasien($id)
    {
        $pasien = Pasien::with(['user'])->where('id', $id)->first();
        $operation = 'edit';
        $pasiens = Pasien::with(['user'])->get();
        return view('dashboard.managePasien', compact('pasien', 'pasiens', 'operation'));
    }

    // view admin dokter functions
    public function manageDokter()
    {
        $dokters = Dokter::with(['user', 'poli'])->get();
        $polis = Poli::all();
        $operation = 'noedit';
        return view('dashboard.manageDokter', compact('dokters', 'polis', 'operation'));
    }

    public function editDokter($id)
    {
        $dokters = Dokter::with(['user', 'poli'])->get();
        $dokter = Dokter::with(['user', 'poli'])->where('id', $id)->first();
        $polis = Poli::all();
        $operation = 'edit';
        return view('dashboard.manageDokter', compact('dokters', 'dokter', "polis", 'operation'));
    }

    // view admin poli functions
    public function managePoli()
    {
        $polis = Poli::all();
        $operation = 'noedit';
        return view('dashboard.managePoli', compact('polis', 'operation'));
    }
    public function editPoli($id)
    {
        $poli = Poli::where('id', $id)->first();
        $polis = Poli::all();
        $operation = 'edit';
        return view('dashboard.managePoli', compact('polis', 'poli', 'operation'));
    }

    // view admin obat functions
    public function editObatProses($id, Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required|integer',
        ]);

        $obat = Obat::where('id', $id)->first();

        $obat->update([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => (int) $request->input('harga'),
        ]);

        return redirect('/manage-obat')->with('success', 'Obat updated successfully!');
    }

    public function tambahObatProses(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required|integer',
        ]);

        Obat::create([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => (int) $request->input('harga'),
        ]);

        return redirect('/manage-obat')->with('success', 'Obat added successfully!');
    }

    public function deleteObatProses($id)
    {
        $obat = Obat::where('id', $id)->first();
        $obat->delete();
        return redirect('/manage-obat')->with('success', 'Obat deleted successfully!');
    }

    // admin pasien proses functions
    public function editPasienProses($id, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password-lama' => 'required|min:2',
            'password-baru' => 'required|min:2',
        ]);

        $pasien = Pasien::where('id', $id)->first();
        $user = User::where('id', $pasien->id_akun)->first();
        // dd($pasien, $user);
        if (!password_verify($request->input('password-lama'), $user->password)) {
            return back()->withErrors(['password-lama' => 'Password lama tidak sama!'])->withInput();
        }

        $pasien->update([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'no_hp' => $request->input('no_hp'),
        ]);

        $user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password-baru'),
        ]);

        return redirect('/manage-pasien')->with('success', 'Pasien updated successfully!');
    }

    public function tambahPasienProses(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:2',
        ]);

        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'pasien',
        ]);

        Pasien::create([
            'id_akun' => $user->id,
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'no_hp' => $request->input('no_hp'),
            'no_rm' => $this->generateNoRM(),
        ]);

        return redirect('/manage-pasien')->with('success', 'Pasien added successfully!');
    }

    protected function generateNoRM()
    {
        $year = date('Y'); // Get the current year
        $month = date('m'); // Get the current month
        $all_patients = Pasien::count();
        $no_rm = $year . $month . '-' . ($all_patients + 1); // Generate the no_rm
        return $no_rm;
    }
    public function deletePasienProses($id)
    {
        $pasien = Pasien::where('id', $id)->first();
        $user = User::where('id', $pasien->id_akun)->first();
        $pasien->delete();
        $user->delete();
        return redirect('/manage-pasien')->with('success', 'Pasien deleted successfully!');
    }

    // admin poli proses functions

    public function editPoliProses($id, Request $request)
    {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required',
        ]);

        $poli = Poli::where('id', $id)->first();

        $poli->update([
            'nama_poli' => $request->input('nama_poli'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect('/manage-poli')->with('success', 'Poli updated successfully!');
    }
    public function tambahPoliProses(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required',
        ]);

        Poli::create([
            'nama_poli' => $request->input('nama_poli'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect('/manage-poli')->with('success', 'Poli added successfully!');
    }
    public function deletePoliProses($id)
    {
        $poli = Poli::where('id', $id)->first();
        $poli->delete();
        return redirect('/manage-poli')->with('success', 'Poli deleted successfully!');
    }
    // admin dokter proses functions
    public function deleteDokterProses($id)
    {
        $dokter = Dokter::where('id', $id)->first();
        $user = User::where('id', $dokter->id_akun)->first();
        $dokter->delete();
        $user->delete();
        return redirect()->route('manageDokter')->with('success', 'Dokter deleted successfully!');
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

        return redirect()->route('manageDokter')->with('success', 'Dokter added successfully!');
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

        $dokter = Dokter::where('id', $id)->first();
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

        return redirect()->route('manageDokter')->with('success', 'Dokter updated successfully!');
    }
}
