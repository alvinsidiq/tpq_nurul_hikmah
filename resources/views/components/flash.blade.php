@if(session('success'))
<div class="bg-green-100 p-2 rounded mb-3">{{ session('success') }}</div>
@endif
@if($errors->any())
<div class="bg-red-100 p-2 rounded mb-3">
    <ul>
        @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

