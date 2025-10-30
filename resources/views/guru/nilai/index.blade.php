<x-app-layout>
    <x-slot name="header"><h2>Input Nilai - Pilih Kelas & Parameter</h2></x-slot>
    <div class="p-6 max-w-4xl">
        <x-flash/>
        <form method="GET" action="{{ route('guru.nilai.form', ['kelas' => 'KELAS_ID']) }}" id="nilaiForm" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block">Kelas</label>
                <select id="kelasSelect" class="border p-2 w-full" required>
                    @foreach($kelas as $id=>$nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Mata Pelajaran</label>
                <select name="mata_pelajaran_id" class="border p-2 w-full" required>
                    @foreach($mapels as $id=>$nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Semester</label>
                <select name="semester_id" class="border p-2 w-full" required>
                    @foreach($semesters as $id=>$nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Tahun Ajaran</label>
                <select name="tahun_ajaran_id" class="border p-2 w-full" required>
                    @foreach($tahunAjarans as $id=>$nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Jenis Penilaian</label>
                <select name="jenis_penilaian" class="border p-2 w-full" required>
                    @foreach(['UH'=>'Ulangan Harian','UTS'=>'UTS','UAS'=>'UAS','Praktik'=>'Praktik'] as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" class="border p-2 w-full" required>
            </div>
            <div class="md:col-span-3">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Lanjut</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('nilaiForm').addEventListener('submit', function(e){
            e.preventDefault();
            const params = new URLSearchParams(new FormData(this)).toString();
            const kelasId = document.getElementById('kelasSelect').value;
            const url = "{{ route('guru.nilai.form', ['kelas' => 'KELAS_ID']) }}".replace('KELAS_ID', kelasId) + '?' + params;
            window.location.href = url;
        });
    </script>
</x-app-layout>

