<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

        // Clave foránea a la compañía

        // Datos personales
        $table->string('name');
            $table->string('code')->unique();

        $table->string('rut')->unique();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();

        // Nuevos campos
        $table->string('photo')->nullable(); // Ruta a la foto (archivo o URL)
        $table->string('position')->nullable(); // Cargo en la compañía

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
