@include('layout.head')

@include('layout.DokterHeaderContentPeriksa')
<!--Container-->
<div class="container w-full mx-auto pt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white">
        <h2 class="text-2xl font-bold mb-4">Example Datatable</h2>
        <table id="example" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Keluhan</th>
                    <th class="px-4 py-2">No. Antrian</th>
                    <th class="px-4 py-2">Age</th>
                    <th class="px-4 py-2">Start date</th>
                    <th class="px-4 py-2">Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">Tiger Nixon</td>
                    <td class="border px-4 py-2">System Architect</td>
                    <td class="border px-4 py-2">Edinburgh</td>
                    <td class="border px-4 py-2">61</td>
                    <td class="border px-4 py-2">2011/04/25</td>
                    <td class="border px-4 py-2">$320,800</td>
                </tr>
                <!-- Add more rows as needed -->
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
    <div class=" mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="text-2xl py-4 px-6 bg-gray-900 text-white text-center font-bold uppercase">
            Periksa Pasien
        </div>
        <form class="py-4 px-6" action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="tanggal_pemeriksaan">
                    Tanggal Pemeriksaan
                </label>
                <input name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="keluhan">
                    Keluhan
                </label>
                <input name="keluhan" id="keluhan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Masukkan keluhan pasien" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="no_antrian">
                    Nomor Antrian
                </label>
                <input name="no_antrian" id="no_antrian" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Nomor Antrian" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="pilihan_obat">
                    Pilihan Obat
                </label>
                <input name="pilihan_obat" id="pilihan_obat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Pilih obat yang diresepkan" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="catatan">
                    Catatan
                </label>
                <textarea name="catatan" id="catatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" placeholder="Catatan pemeriksaan"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="biaya_periksa">
                    Biaya Periksa
                </label>
                <input name="biaya_periksa" id="biaya_periksa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="Biaya Pemeriksaan" required>
            </div>
            <div class="flex items-center justify-center mb-4">
                <button class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline" type="submit">
                    Simpan Pemeriksaan
                </button>
            </div>
        </form>
    </div>
</div>

@include('layout.foot')
