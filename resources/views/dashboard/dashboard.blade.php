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
            {{-- error/success session --}}
            @if (session('error'))
                <div class="flex flex-col gap-3">
                    <div
                        class="flex bg-white dark:bg-gray-900 items-center px-6 py-4 text-sm border-t-2 rounded-b shadow-sm border-red-500">
                        <svg viewBox="0 0 24 24" class="w-8 h-8 text-red-500 stroke-current" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 8V12V8ZM12 16H12.01H12ZM21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <div class="ml-3">
                            <div class="font-bold text-left text-black dark:text-gray-50">Access denied</div>
                            <div class="w-full text-gray-900 dark:text-gray-300 mt-1">{{ session('error') }}</div>
                        </div>
                    </div>
                </div>
            @elseif (session('success'))
                <div class="flex flex-col gap-3">
                    <div
                        class="flex bg-white dark:bg-gray-900 items-center px-6 py-4 text-sm border-t-2 rounded-b shadow-sm border-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500 stroke-current"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <div class="ml-3">
                            <div class="font-bold text-left text-black dark:text-gray-50">Your entry has been saved
                            </div>
                            <div class="w-full text-gray-900 dark:text-gray-300 mt-1">{{ session('success') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- /error/success session --}}
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
                                class="cursor-pointer rounded-lg bg-blue-700 px-8 py-5 text-sm font-semibold text-white">Daftar
                                Poli</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- table di daftar poli pasien --}}
            <div class="mx-14 mt-10 border-2 border-blue-400 rounded-lg bg-white">
                <h2 class="text-2xl font-bold mb-4">Riwayat Daftar Poli</h2>
                <table id="example" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Poli</th>
                            <th class="px-4 py-2">Dokter</th>
                            <th class="px-4 py-2">Hari</th>
                            <th class="px-4 py-2">Mulai</th>
                            <th class="px-4 py-2">Selesai</th>
                            <th class="px-4 py-2">Antrian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cekPendaftaran as $pendaftaran)
                            <tr>
                                <td class="border px-4 py-2">{{ $pendaftaran->nama_poli }}</td>
                                <td class="border px-4 py-2">{{ $pendaftaran->nama }}</td>
                                <td class="border px-4 py-2">{{ $pendaftaran->hari }}</td>
                                <td class="border px-4 py-2">{{ $pendaftaran->jam_mulai }}</td>
                                <td class="border px-4 py-2">{{ $pendaftaran->jam_selesai }}</td>
                                <td class="border px-4 py-2">{{ $pendaftaran->no_antrian }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        // Add any customization options here
                    });
                });
            </script>
            {{-- /table di daftar poli pasien --}}
        @elseif (Auth::user()->role == 'dokter')
            {{-- error/success session --}}
            @if (session('error'))
                <div class="flex flex-col gap-3">
                    <div
                        class="flex bg-white dark:bg-gray-900 items-center px-6 py-4 text-sm border-t-2 rounded-b shadow-sm border-red-500">
                        <svg viewBox="0 0 24 24" class="w-8 h-8 text-red-500 stroke-current" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 8V12V8ZM12 16H12.01H12ZM21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <div class="ml-3">
                            <div class="font-bold text-left text-black dark:text-gray-50">Error</div>
                            <div class="w-full text-gray-900 dark:text-gray-300 mt-1">{{ session('error') }}</div>
                        </div>
                    </div>
                </div>
            @elseif (session('success'))
                <div class="flex flex-col gap-3">
                    <div
                        class="flex bg-white dark:bg-gray-900 items-center px-6 py-4 text-sm border-t-2 rounded-b shadow-sm border-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500 stroke-current"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <div class="ml-3">
                            <div class="font-bold text-left text-black dark:text-gray-50">Success
                            </div>
                            <div class="w-full text-gray-900 dark:text-gray-300 mt-1">{{ session('success') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- /error/success session --}}
            <div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="text-2xl py-4 px-6 bg-gray-900 text-white text-center font-bold uppercase">
                    Jadwal Periksa
                </div>
                @if ($operation == 'input')
                    @include('dokter.formInputNTable')
                @elseif ($operation == 'edit')
                    @include('dokter.formEdit')
                @elseif ($operation == 'noinput')
                    @include('dokter.formInputDisable')
                @endif
            </div>
        @endif


    </div>
</div>

@include('layout.foot')
