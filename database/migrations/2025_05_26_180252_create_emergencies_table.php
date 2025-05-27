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
        Schema::create('emergencies', function (Blueprint $table) {
                    $table->foreignId('emergency_type_id')->constrained()->onDelete('cascade');

        $table->id();
        $table->string('type');
        $table->string('address');
        $table->text('description')->nullable();
        $table->enum('priority', ['alta', 'media', 'baja'])->default('media');
        $table->enum('status', ['pendiente', 'en_camino', 'finalizada'])->default('pendiente');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergencies');
    }
};
