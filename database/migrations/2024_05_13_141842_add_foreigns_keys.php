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

        //Foreign key [prestamos - clientes]
        Schema::table('prestamos', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
        });

        //Foreign key [depositos - prestamos]
        Schema::table('depositos', function (Blueprint $table) {
            $table->foreign('id_prestamo')->references('id')->on('prestamos')->onDelete('cascade');
        });

        //Foreign key [transacciones - clientes (cliente 1)]
        Schema::table('transacciones', function (Blueprint $table) {
            $table->foreign('cliente_id_enviado')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cliente_id_recibido')->references('id')->on('users')->onDelete('cascade');
        });

        //Foreign key [ingresos - clientes]
        Schema::table('ingresos', function (Blueprint $table) {
            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
        });

        //Foreign key [ingresos - cat_referencias]
        Schema::table('ingresos', function (Blueprint $table) {
            $table->foreign('id_referencia')->references('id')->on('cat_referencias')->onDelete('cascade');
        });

        //Foreign key [egresos - clientes]
        Schema::table('egresos', function (Blueprint $table) {
            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
        });

        //Foreign key [egresos - cat_referencias]
        Schema::table('egresos', function (Blueprint $table) {
            $table->foreign('id_referencia')->references('id')->on('cat_referencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Foreign key [prestamos - clientes]
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
        });

        //Foreign key [depositos - prestamos]
        Schema::table('depositos', function (Blueprint $table) {
            $table->dropForeign(['id_prestamo']);
        });

        //Foreign key [transacciones - clientes (cliente 1)]
        Schema::table('transacciones', function (Blueprint $table) {
            $table->dropForeign(['cliente_id_enviado']);
            $table->dropForeign(['cliente_id_recibido']);
        });

        //Foreign key [ingresos - clientes]
        Schema::table('ingresos', function (Blueprint $table) {
            $table->dropForeign(['id_cliente']);
        });

        //Foreign key [ingresos - cat_referencias]
        Schema::table('ingresos', function (Blueprint $table) {
            $table->dropForeign(['id_referencia']);
        });

        //Foreign key [egresos - clientes]
        Schema::table('egresos', function (Blueprint $table) {
            $table->dropForeign(['id_cliente']);
        });

        //Foreign key [egresos - cat_referencias]
        Schema::table('egresos', function (Blueprint $table) {
            $table->dropForeign(['id_referencia']);
        });
    }
};
