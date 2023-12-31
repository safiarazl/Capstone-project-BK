<form class="py-4 px-6" action="{{ route('inputJadwalProses') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service">
            Hari
        </label>
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
    </div>
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
    <div class="flex items-center justify-center mb-4">
        <button
            class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
            type="submit">
            Submit
        </button>
    </div>

</form>
