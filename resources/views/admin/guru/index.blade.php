<x-app-layout>
    <x-slot name="header"><h2>Data Guru</h2></x-slot>
    <div class="p-6 max-w-7xl mx-auto">
        <x-flash/>
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">Total: {{ $items->total() }} data</div>
            <a class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded" href="{{ route('admin.guru.create') }}">Tambah</a>
        </div>
        <div class="mt-4 overflow-x-auto bg-white rounded shadow">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 text-gray-700">
                    <tr><th class="p-2 text-left">Nama Lengkap</th><th class="p-2 text-left">Email</th><th class="p-2 text-left">No Telepon</th><th class="p-2 text-left">Alamat</th><th class="p-2 text-left w-40">Aksi</th></tr>
                </thead>
                <tbody class="divide-y">
                @forelse($items as $i)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2">{{ $i->nama_lengkap }}</td>
                        <td class="p-2">{{ $i->user?->email }}</td>
                        <td class="p-2">{{ $i->no_telepon ?? '-' }}</td>
                        <td class="p-2">{{ Str::limit($i->alamat, 50) }}</td>
                        <td class="p-2">
                            <a class="inline-block text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-xs" href="{{ route('admin.guru.edit',$i) }}">Edit</a>
                            <form action="{{ route('admin.guru.destroy',$i) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="inline-block ml-2 text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-xs" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-gray-500">Belum ada data.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</x-app-layout>
