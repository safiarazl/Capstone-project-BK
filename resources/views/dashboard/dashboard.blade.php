@include('layout.head')

@include('layout.header')
<!--Container-->
<div class="container w-full mx-auto pt-20">

    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <!--Console Content-->
        @if (Auth::user()->role == 'admin')
            <div class="flex flex-wrap">

                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-pink-600"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Total Users</h5>
                                <h3 class="font-bold text-3xl text-gray-600">{{ ucwords($user) }} <span
                                        class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-pink-600"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Total Pasien</h5>
                                <h3 class="font-bold text-3xl text-gray-600">{{ ucwords($pasien) }}<span
                                        class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-pink-600"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Total Dokter</h5>
                                <h3 class="font-bold text-3xl text-gray-600">{{ ucwords($dokter) }}<span
                                        class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-600"><i
                                        class="fas fa-server fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Obat</h5>
                                <h3 class="font-bold text-3xl text-gray-600">{{ ucwords($obat) }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-indigo-600"><i
                                        class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Poli</h5>
                                <h3 class="font-bold text-3xl text-gray-600">{{ ucwords($poli) }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>
        @elseif (Auth::user()->role == 'pasien')
            <div class="mx-14 mt-10 border-2 border-blue-400 rounded-lg bg-white">
                <div class="mt-3 text-center text-4xl font-bold">Pendaftaran Poliklinik</div>
                <div class="p-8">
                    <form method="POST" action="{{ route('daftarPoliProses') }}">
                        @csrf
                        <div class="my-6 flex gap-4">
                            <input type="Name" name="name"
                                class="mt-1 block w-1/2 rounded-md border border-slate-300 bg-white px-3 py-4 placeholder-slate-400 shadow-sm placeholder:font-semibold placeholder:text-gray-500 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
                                value="{{ ucwords(Auth::user()->name) }}" disabled />
                            <select name="jadwal" id="jadwal"
                                class="block w-1/2 rounded-md border border-slate-300 bg-white px-3 py-4 font-semibold text-gray-500 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm">
                                <option class="font-semibold text-slate-300">Pilih Jadwal</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal['id'] }}">{{ ucwords($jadwal->dokter->nama) }} -
                                        {{ $jadwal->dokter->poli->nama_poli }} -
                                        {{ $jadwal->hari }} - {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <textarea name="keluhan" id="keluhan" cols="30" rows="10"
                                class="mb-10 h-40 w-full resize-none rounded-md border border-slate-300 p-5 font-semibold text-gray-300"
                                placeholder="Keluhan"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="cursor-pointer rounded-lg bg-blue-700 px-8 py-5 text-sm font-semibold text-white">Book
                                Appoinment</button>
                        </div>
                    </form>
                </div>
            </div>
        @elseif (Auth::user()->role == 'dokter')
            <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="text-2xl py-4 px-6 bg-gray-900 text-white text-center font-bold uppercase">
                    Input Jadwal
                </div>
                <form class="py-4 px-6" action="{{ route('inputJadwalProses') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="service">
                            Hari
                        </label>
                        @if ($cekJadwal->count() != 0)
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="hari" name="hari" disabled>
                                @foreach ($cekJadwal as $jadwal)
                                    <option value="{{ $jadwal->hari }}"> {{ $jadwal->hari }} </option>
                                @endforeach

                            </select>
                        @elseif ($cekJadwal->count() == 0)
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="hari" name="hari">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        @endif
                    </div>
                    @if ($cekJadwal->count() != 0)
                        @foreach ($cekJadwal as $jadwal)
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="time">
                                    Jam Mulai
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="" name="" type="time" value="{{ $jadwal->jam_mulai }}"
                                    disabled>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="time">
                                    Jam Selesai
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="" name="" type="time"
                                    value="{{ $jadwal->jam_selesai }}" disabled>
                            </div>
                        @endforeach
                    @elseif ($cekJadwal->count() == 0)
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="time">
                                Jam Mulai
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="jam_mulai" name="jam_mulai" type="time">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="time">
                                Jam Selesai
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="jam_selesai" name="jam_selesai" type="time">
                        </div>
                    @endif
                    <div class="flex items-center justify-center mb-4">
                        <button
                            class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            type="submit">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        @endif


    </div>
</div>

@include('layout.foot')
