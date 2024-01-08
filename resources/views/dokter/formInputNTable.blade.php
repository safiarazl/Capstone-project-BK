{{-- table --}}
<div class="container mx-auto max-w-full px-4 sm:px-6 lg:px-8 py-8 bg-white">
    <h2 class="text-2xl font-bold mb-4">Input Datatable</h2>
    <table id="example" class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Dokter</th>
                <th class="px-4 py-2">Hari</th>
                <th class="px-4 py-2">Jam Mulai</th>
                <th class="px-4 py-2">Jam Selesai</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwalDokters as $table)
                <tr>
                    <td class="border px-4 py-2">{{ isset($table['nama']) ? $table['nama'] : 'Nama Not Found' }}</td>
                    <td class="border px-4 py-2">{{ isset($table['hari']) ? $table['hari'] : 'Hari Not Found' }}</td>
                    <td class="border px-4 py-2">
                        {{ isset($table['jam_mulai']) ? $table['jam_mulai'] : 'Jam Mulai Not Found' }}</td>
                    <td class="border px-4 py-2">
                        {{ isset($table['jam_selesai']) ? $table['jam_selesai'] : 'Jam Selesai Not Found' }}</td>
                    <td class="border px-4 py-2">{{ isset($table['status']) ? $table['status'] : 'Status Not Found' }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('editJadwal', $table['id']) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pilih</a>
                    </td>
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
            order: [
                [2, 'asc']
            ], // 2 is the column index (0-based) for "No. Antrian"
            // Add any other customization options here
        });
    });
</script>
{{-- /table --}}
<form class="py-4 px-6" action="{{ route('inputJadwalProses') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service">
            Hari
        </label>
        <select
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="hari" name="hari">
            @foreach ($keys as $hari)
                @if ($hari != 'Minggu')
                    <option value="{{ $hari }}">
                        {{ ucwords(strtolower($hari)) }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="time">
            Jam Mulai
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="jam_mulai" name="jam_mulai" value="" type="time">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="time">
            Jam Selesai
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="jam_selesai" name="jam_selesai" type="time" value="">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="status">
            Status
        </label>
        <div class="flex items-center">
            <input type="radio" id="status_y" name="status" value="Y" class="mr-2">
            <label for="status_y" class="mr-4">Aktif</label>
            <input type="radio" id="status_n" name="status" value="N" class="mr-2">
            <label for="status_n" class="mr-4">Tidak Aktif</label>
        </div>
    </div>
    <div class="flex items-center justify-center mb-4">
        <button
            class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
            type="submit">
            Submit
        </button>
    </div>
</form>
