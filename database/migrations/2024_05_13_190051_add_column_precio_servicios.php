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
        Schema::table('cat_servicios', function (Blueprint $table) {
            $table->double('precio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_servicios', function (Blueprint $table) {
            $table->dropColumn('precio'); // Si necesitas revertir la migración
        });
    }
};
