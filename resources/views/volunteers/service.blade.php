@extends('layouts.guest')

@section('content')
<div class="space-y-6 text-center">
    <h1 class="text-xl font-bold">Hola {{ $volunteer->name }}</h1>
    <p class="text-gray-600">Estado actual: <span class="font-semibold">{{ $volunteer->service_code == '09' ? 'En servicio' : 'No disponible' }}</span></p>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
    @endif
    <form action="{{ route('volunteers.service.update', $volunteer) }}" method="POST" class="space-y-4">
        @csrf
        <button type="submit" name="service_code" value="09" class="w-full bg-green-600 text-white py-2 rounded">Quedar en servicio (09)</button>
        <button type="submit" name="service_code" value="08" class="w-full bg-red-600 text-white py-2 rounded">No disponible (08)</button>
    </form>
</div>
@endsection
