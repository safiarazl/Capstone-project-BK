@include('layout.head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                    <th class="px-4 py-2">Poli</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">No. HP</th>
                    <th class="px-4 py-2">No. RM</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftar_poli as $table)
                    <tr>
                        <td class="border px-4 py-2">{{ $table->nama }}</td>
                        <td class="border px-4 py-2">{{ $table->keluhan }}</td>
                        <td class="border px-4 py-2">{{ $table->no_antrian }}</td>
                        <td class="border px-4 py-2">{{ $table->nama_poli }}</td>
                        <td class="border px-4 py-2">{{ $table->alamat }}</td>
                        <td class="border px-4 py-2">{{ $table->no_hp }}</td>
                        <td class="border px-4 py-2">{{ $table->no_rm }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('periksaPasienProses', $table->id_pasien) }}"
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
    <div class=" mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="text-2xl py-4 px-6 bg-gray-900 text-white text-center font-bold uppercase">
            Periksa Pasien
        </div>
        @if (session('success'))
            <div id="alert" class="bg-green-200 border-green-600 text-green-600 border-l-4 p-4 hidden"
                role="alert">
                <p class="font-bold">
                    Success
                </p>
                <p>
                    {{ session('success') }}
                </p>
            </div>
        @endif
        @if ($pasienTerpilih == 'belumDipilih')
            <form class="py-4 px-6" action="{{ route('periksaPasien') }}" method="POST" name="formPeriksa"
                id="formPeriksa">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="no_antrian">
                        Nomor Antrian
                    </label>
                    <input name="no_antrian" id="no_antrian" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        disabled>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="no_antrian">
                        Nama Pasien
                    </label>
                    <input name="nama_pasien" id="nama_pasien" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        disabled>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="keluhan">
                        Keluhan
                    </label>
                    <input name="keluhan" id="keluhan" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        disabled>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tanggal_pemeriksaan">
                        Tanggal Pemeriksaan
                    </label>
                    <input name="tanggal_pemeriksaan" id="tanggal_pemeriksaan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="datetime" value="{{ $today }}" disabled>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="pilihan_obat">
                        Pilihan Obat
                    </label>
                    <select name="pilihan_obat[]" id="pilihan_obat"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        multiple disabled>
                        @foreach ($allObat as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} - {{ $obat->kemasan }} -
                                {{ $obat->harga }}</option>
                        @endforeach
                        <!-- Tambahkan opsi obat lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="catatan">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4" placeholder="Catatan pemeriksaan" disabled></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="biaya_periksa">
                        Biaya Periksa
                    </label>
                    <input name="biaya_periksa" id="biaya_periksa"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Biaya Pemeriksaan" disabled>
                </div>
                <div class="flex items-center justify-center mb-4">
                    <button
                        class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Simpan Pemeriksaan
                    </button>
                </div>

            </form>
            @else
            <form class="py-4 px-6" action="{{ route('periksaPasienProsesInsert', $pasienTerpilih->id_pasien) }}"
                method="POST" name="formPeriksa" id="formPeriksa">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_daftar_poli" value="{{ $id_daftar_poli }}">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="no_antrian">
                        Nomor Antrian
                    </label>
                    <input name="no_antrian" id="no_antrian" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ $pasienTerpilih->no_antrian }}" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="no_antrian">
                        Nama Pasien
                    </label>
                    <input name="nama_pasien" id="nama_pasien" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ $pasienTerpilih->nama }}" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="keluhan">
                        Keluhan
                    </label>
                    <input name="keluhan" id="keluhan" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ $pasienTerpilih->keluhan }}" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tanggal_pemeriksaan">
                        Tanggal Pemeriksaan
                    </label>
                    <input name="tanggal_pemeriksaan" id="tanggal_pemeriksaan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="datetime" value="{{ $today }}" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="pilihan_obat">
                        Pilihan Obat
                    </label>
                    <select name="pilihan_obat[]" id="pilihan_obat"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        multiple required>
                        @foreach ($allObat as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} -
                                {{ $obat->kemasan }} -
                                {{ $obat->harga }}</option>
                        @endforeach
                        <!-- Tambahkan opsi obat lainnya sesuai kebutuhan -->
                    </select>

                    <!-- Hidden input fields for harga -->
                    @foreach ($hargaDataObat as $obatId => $harga)
                        <input type="hidden" name="harga_obat[{{ $obatId }}]" value="{{ $harga }}">
                    @endforeach
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="catatan">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4" placeholder="Catatan pemeriksaan" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="biaya_periksa">
                        Biaya Periksa
                    </label>
                    <input name="biaya_periksa" id="biaya_periksa"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Biaya Pemeriksaan" hidden>

                    <!-- Display formatted total -->
                    <p class="mt-2">Total: <span id="formattedTotal">0</span></p>
                </div>

                <!-- Hidden input fields for harga -->
                @foreach ($hargaDataObat as $obatId => $harga)
                    <input type="hidden" name="harga_obat[{{ $obatId }}]" value="{{ $harga }}">
                @endforeach
                <div class="flex items-center justify-center mb-4">
                    <button
                        class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        type="button" id="calculateTotal">
                        Calculate Total
                    </button>
                </div>
                <div class="flex items-center justify-center mb-4">
                    <button
                        class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Simpan Pemeriksaan
                    </button>
                </div>

            </form>
        @endif
    </div>
</div>


</div>
<!-- JavaScript to calculate and update total dynamically -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show the alert
        var alertElement = document.getElementById('alert');
        alertElement.classList.remove('hidden');

        // Set a timeout to hide the alert after 3 seconds (adjust the duration as needed)
        setTimeout(function() {
            alertElement.classList.add('hidden');
        }, 3000);
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Function to calculate the total
        function calculateTotal() {
            // Fetch harga from the hidden inputs based on selected obat IDs
            var selectedObatIds = Array.from(document.getElementById('pilihan_obat').selectedOptions)
                .map(option => option.value);
            var total = 0;

            selectedObatIds.forEach(function(obatId) {
                // Add the harga for each selected obat
                var hargaInput = document.querySelector(`input[name="harga_obat[${obatId}]"]`);
                if (hargaInput) {
                    total += parseFloat(hargaInput.value) || 0;
                }
            });

            // Add other calculations or fixed values
            total += 150000;

            // Set the calculated total to a hidden input or display it
            document.getElementById('biaya_periksa').value = total;

            // Display the detailed breakdown
            var formattedTotal = `Total: Rp ${total.toLocaleString('id-ID')}`;
            document.getElementById('formattedTotal').innerText = formattedTotal;
        }

        // Trigger the calculation when the page loads
        calculateTotal();

        // Event listener for the button click
        document.getElementById('calculateTotal').addEventListener('click', function() {
            calculateTotal();
        });

        // If you want to submit the form programmatically, uncomment the following line
        // document.getElementById('formPeriksa').submit();
    });
</script>





@include('layout.foot')
