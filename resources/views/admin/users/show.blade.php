<x-app-layout>
    <x-slot name="header"><h2>Detail Pengguna</h2></x-slot>
    <div class="p-6 max-w-2xl">
        <x-flash/>
        <div class="space-y-2">
            @if($user->foto_path)
                <img src="{{ asset('storage/'.$user->foto_path) }}" alt="Foto {{ $user->name }}" class="h-24 w-24 rounded-2xl object-cover">
            @endif
            <div><strong>Nama:</strong> {{ $user->name }}</div>
            <div><strong>Email:</strong> {{ $user->email }}</div>
            <div><strong>Telepon:</strong> {{ $user->phone }}</div>
            <div><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</div>
            <div><strong>Status:</strong> {{ $user->status }}</div>
            <div><strong>Role:</strong> {{ $user->roles->pluck('name')->join(', ') }}</div>
        </div>
        <div class="mt-4">
            <a class="underline" href="{{ route('admin.users.edit',$user) }}">Edit</a>
            <a class="underline ml-2" href="{{ route('admin.users.index') }}">Kembali</a>
        </div>
    </div>
</x-app-layout>
