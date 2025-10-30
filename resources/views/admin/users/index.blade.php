<x-app-layout>
    <x-slot name="header"><h2>Pengguna</h2></x-slot>
    <div class="p-6">
        <x-flash/>
        <a href="{{ route('admin.users.create') }}" class="underline text-blue-600">Tambah</a>
        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">Nama</th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">Role</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="border-t">
                    <td class="p-2">{{ $u->name }}</td>
                    <td class="p-2">{{ $u->email }}</td>
                    <td class="p-2">{{ $u->roles->pluck('name')->join(', ') }}</td>
                    <td class="p-2">{{ $u->status }}</td>
                    <td class="p-2 space-x-2">
                        <a class="underline text-blue-600" href="{{ route('admin.users.edit',$u) }}">Edit</a>
                        <form action="{{ route('admin.users.destroy',$u) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="underline text-red-600" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                        <form action="{{ route('admin.users.reset-password',$u) }}" method="POST" class="inline">
                            @csrf
                            <button class="underline text-amber-600">Reset Password</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $users->links() }}</div>
    </div>
</x-app-layout>

