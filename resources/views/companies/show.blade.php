<h2>Cargar voluntarios por CSV</h2>

<form action="{{ route('companies.volunteers.import', $company) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" accept=".csv" required>
    <button type="submit">Importar voluntarios</button>
</form>
