<x-app-layout>
    <x-slot name="header"><h2>Admin Dashboard</h2></x-slot>
    <div class="p-6">Dashboard {{ strtoupper(explode('.', Route::currentRouteName())[0]) }}</div>
</x-app-layout>

