@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Agregar voluntario a {{ $company->name }}</h1>
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>¡Ups! Hubo algunos errores:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('volunteers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="hidden" name="company_id" value="{{ $company->id }}">

        <div>
            <label class="block font-medium">Nombre:</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">RUT:</label>
            <input type="text" name="rut" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">Email:</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Teléfono:</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Cargo:</label>
            <input type="text" name="position" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Foto:</label>
            <input type="file" name="photo" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar voluntario</button>
            <a href="{{ route('companies.volunteers', $company) }}" class="text-blue-600 hover:underline mt-2">← Volver al listado</a>
        </div>
    </form>
@endsection
