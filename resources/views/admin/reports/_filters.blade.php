<form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
    <div>
        <label class="block text-sm">Tahun Ajaran</label>
        <select name="tahun_ajaran_id" class="border p-2 w-full">
            <option value="">Semua</option>
            @foreach($tahunAjarans as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['tahun_ajaran_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm">Semester</label>
        <select name="semester_id" class="border p-2 w-full">
            <option value="">Semua</option>
            @foreach($semesters as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['semester_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm">Mata Pelajaran</label>
        <select name="mapel_id" class="border p-2 w-full">
            <option value="">Semua</option>
            @foreach($mapels as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['mapel_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm">Kelas</label>
        <select name="kelas_id" class="border p-2 w-full">
            <option value="">Semua</option>
            @foreach($kelas as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['kelas_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-4 flex items-center gap-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Terapkan</button>
        <a class="underline" href="{{ url()->current() }}">Reset</a>
        <a class="underline text-green-700" href="{{ request()->fullUrlWithQuery(['export'=>'pdf']) }}">Export PDF</a>
        <a class="underline text-emerald-700" href="{{ request()->fullUrlWithQuery(['export'=>'xlsx']) }}">Export Excel</a>
    </div>
</form>

