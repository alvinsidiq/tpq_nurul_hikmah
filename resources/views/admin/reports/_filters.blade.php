<form method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm focus-within:border-zinc-900 transition">
        <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Tahun Ajaran</label>
        <select name="tahun_ajaran_id" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-800 outline-none focus:border-zinc-900">
            <option value="">Semua</option>
            @foreach($tahunAjarans as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['tahun_ajaran_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm focus-within:border-zinc-900 transition">
        <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Semester</label>
        <select name="semester_id" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-800 outline-none focus:border-zinc-900">
            <option value="">Semua</option>
            @foreach($semesters as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['semester_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm focus-within:border-zinc-900 transition">
        <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Mata Pelajaran</label>
        <select name="mapel_id" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-800 outline-none focus:border-zinc-900">
            <option value="">Semua</option>
            @foreach($mapels as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['mapel_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm focus-within:border-zinc-900 transition">
        <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Kelas</label>
        <select name="kelas_id" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-800 outline-none focus:border-zinc-900">
            <option value="">Semua</option>
            @foreach($kelas as $id=>$nama)
                <option value="{{ $id }}" @selected(($q['kelas_id'] ?? '')==$id)>{{ $nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2 lg:col-span-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
        <div class="flex flex-wrap gap-2">
            <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-5 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                Terapkan Filter
            </button>
            <a class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-5 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50" href="{{ url()->current() }}">
                Reset
            </a>
        </div>
        <div class="flex flex-wrap gap-2">
            <a class="inline-flex items-center gap-2 rounded-xl border border-rose-200 px-4 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50" href="{{ request()->fullUrlWithQuery(['export'=>'pdf']) }}">
                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 3h8l3 4v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/><path d="M13 3v5h5"/></svg>
                Export PDF
            </a>
            <a class="inline-flex items-center gap-2 rounded-xl border border-emerald-200 px-4 py-2 text-xs font-semibold text-emerald-700 hover:bg-emerald-50" href="{{ request()->fullUrlWithQuery(['export'=>'xlsx']) }}">
                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 3h8l3 4v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/><path d="M7 13l2-3 2 3m2 0l-2-3 2-3"/></svg>
                Export Excel
            </a>
        </div>
    </div>
</form>
