<x-app-layout>
    <x-slot name="header"><h2>Data Santri</h2></x-slot>
    <div class="p-6 max-w-7xl mx-auto">
        <x-flash/>
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">Total: {{ $items->total() }} data</div>
            <a class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded" href="{{ route('admin.santri.create') }}">Tambah</a>
        </div>
        <div class="mt-4 overflow-x-auto bg-white rounded shadow">
            <table class="table-auto w-full min-w-[760px]">
                <thead class="bg-gray-50 text-gray-700">
                    <tr><th class="p-2 text-left">NIS</th><th class="p-2 text-left">Nama</th><th class="p-2 text-left">Kelas</th><th class="p-2 text-left">Wali</th><th class="p-2 text-left">Jilid</th><th class="p-2 text-left">Foto</th><th class="p-2 text-left w-40">Aksi</th></tr>
                </thead>
                <tbody class="divide-y">
                @forelse($items as $i)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2">{{ $i->nis }}</td>
                        <td class="p-2">{{ $i->nama_lengkap }}</td>
                        <td class="p-2">{{ $i->kelas?->nama_kelas ?? '-' }}</td>
                        <td class="p-2">{{ $i->wali?->name ?? '-' }}</td>
                        <td class="p-2">{{ $i->jilid_level }}</td>
                        <td class="p-2">
                            @if($i->foto_path)
                                <img src="{{ asset('storage/'.$i->foto_path) }}" alt="foto" class="h-10 w-10 object-cover rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-2">
                            <a class="inline-block text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-xs" href="{{ route('admin.santri.edit',$i) }}">Edit</a>
                            <form action="{{ route('admin.santri.destroy',$i) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="inline-block ml-2 text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-xs" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-6 text-center text-gray-500">Belum ada data.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</x-app-layout>
