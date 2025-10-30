<x-app-layout>
    <x-slot name="header"><h2>Kelas Saya</h2></x-slot>
    <div class="p-6">
        <x-flash/>
        <table class="w-full mt-4">
            <thead>
                <tr><th>Nama Kelas</th><th>Kapasitas</th><th>Level Jilid</th><th></th></tr>
            </thead>
            <tbody>
            @forelse($items as $i)
                <tr>
                    <td>{{ $i->nama_kelas }}</td>
                    <td>{{ $i->kapasitas }}</td>
                    <td>{{ $i->level_jilid }}</td>
                    <td>
                        <a class="underline text-blue-600" href="{{ route('guru.kelas.edit',$i) }}">Edit</a>
                        <a class="underline text-gray-600 ml-2" href="{{ route('guru.kelas.show',$i) }}">Detail</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-gray-500 p-4">Belum ada kelas yang diampu.</td></tr>
            @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</x-app-layout>

