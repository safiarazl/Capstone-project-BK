@include('layout.head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@include('layout.DokterHeaderContentRiwayat')
<!--Container-->
<div class="container w-full mx-auto pt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white">
        <h2 class="text-2xl font-bold mb-4">Example Datatable</h2>
        <table id="example" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Keluhan</th>
                    <th class="px-4 py-2">Tanggal Periksa</th>
                    <th class="px-4 py-2">Catatan</th>
                    <th class="px-4 py-2">Obat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periksa as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item['nama'] }}</td>
                        <td class="border px-4 py-2">{{ $item['keluhan'] }}</td>
                        <td class="border px-4 py-2">{{ $item['tgl_periksa'] }}</td>
                        <td class="border px-4 py-2">{{ $item['catatan'] }}</td>
                        <td class="border px-4 py-2">
                            @foreach ($item['obat'] as $obat)
                                {{ $obat['nama_obat'] }}<br>
                            @endforeach
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
</div>
@include('layout.foot')
