@extends('layouts.app')

@section('content')
    <h1>Registrar nueva compañía</h1>

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <label>Nombre de la compañía:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Código:</label><br>
        <input type="text" name="code" required placeholder="Ej: 2da Cía"><br><br>

        <button type="submit">Guardar compañía</button>
    </form>

    <br>
    <a href="{{ route('companies.index') }}">← Volver al listado</a>
@endsection
