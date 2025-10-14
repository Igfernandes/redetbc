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
        // Cria a tabela caso não exista
        if (!Schema::hasTable('bravo_booking_passengers')) {
            Schema::create('bravo_booking_passengers', function (Blueprint $table) {
                $table->id();
                
                // Relacionamento com booking
                $table->unsignedBigInteger('booking_id')->index();

                // Relacionamento polimórfico opcional
                $table->string('object_model', 50)->nullable();
                $table->unsignedBigInteger('object_id')->nullable();
                $table->index(['object_model', 'object_id']);

                // Dados do passageiro
                $table->string('name');
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->integer('age')->nullable();

                // Controle de soft deletes e timestamps
                $table->softDeletes();
                $table->timestamps();
            });
        } else {
            // Caso a tabela exista, adiciona colunas que não existem
            Schema::table('bravo_booking_passengers', function (Blueprint $table) {
                if (!Schema::hasColumn('bravo_booking_passengers', 'object_model')) {
                    $table->string('object_model', 50)->nullable();
                    $table->unsignedBigInteger('object_id')->nullable();
                    $table->index(['object_model', 'object_id']);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bravo_booking_passengers');
    }
};
