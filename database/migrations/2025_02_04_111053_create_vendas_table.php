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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned()->nullable(false);
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamp('data_venda')->nullable(false);
            $table->decimal('subtotal', 10,2)->nullable(false)->default(0.00);
            $table->decimal('desconto')->nullable(false)->default(0.00);
            $table->decimal('total')->nullable(false)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
