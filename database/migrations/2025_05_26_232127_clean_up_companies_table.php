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
         Schema::table('companies', function (Blueprint $table) {
        if (Schema::hasColumn('companies', 'rut')) {
            $table->dropColumn('rut');
        }
        if (Schema::hasColumn('companies', 'company_id')) {
            $table->dropColumn('company_id');
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
