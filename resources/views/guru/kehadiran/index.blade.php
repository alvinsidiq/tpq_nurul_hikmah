<x-app-layout>
    <x-slot name="header"><h2>Kehadiran - Pilih Kelas & Tanggal</h2></x-slot>
    <div class="p-6 max-w-xl">
        <x-flash/>
        <form method="GET" action="{{ route('guru.kehadiran.form', ['kelas' => 'KELAS_ID']) }}" id="kehadiranForm" class="space-y-4">
            <div>
                <label class="block">Kelas</label>
                <select id="kelasSelect" class="border p-2 w-full" required>
                    @foreach($kelas as $id => $nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" class="border p-2 w-full" required>
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Lanjut</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('kehadiranForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const kelasId = document.getElementById('kelasSelect').value;
            const params = new URLSearchParams(new FormData(this)).toString();
            const url = "{{ route('guru.kehadiran.form', ['kelas' => 'KELAS_ID']) }}".replace('KELAS_ID', kelasId) + '?' + params;
            window.location.href = url;
        });
    </script>
</x-app-layout>

