@extends('layouts.guest')

@section('content')
<div class="space-y-6">
    <h1 class="text-xl font-bold text-center">Registro de Voluntario</h1>
    <form action="{{ route('volunteers.signup.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">Compañía</label>
            <select name="company_id" class="w-full border rounded px-3 py-2" required>
                <option value="" disabled selected>Seleccione...</option>
                @foreach($companies as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1">Nombre</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-1">RUT</label>
            <input type="text" name="rut" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-1">Correo</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-1">Teléfono</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-1">Cargo</label>
            <input type="text" name="position" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Registrarse</button>
    </form>
</div>
@endsection
