<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Essa tabela armazena os dados bancários do cliente
     * para transferências, TED ou PIX.
     */
    public function up(): void
    {
        Schema::create('core_withdraw_accounts', function (Blueprint $table) {
            $table->id();

            // 🔗 Relacionamento com o usuário
            $table->unsignedBigInteger('user_id')->index();

            // 🏦 Dados da conta bancária
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('owner_name');
            $table->string('owner_birthdate')->nullable();
            $table->string('document');
            $table->string('agency')->nullable();
            $table->string('account')->nullable();
            $table->string('account_digit')->nullable();

            // 🔸 Tipo de conta
            $table->enum('bank_account_type', ['CONTA_CORRENTE', 'CONTA_POUPANCA'])->default('CONTA_CORRENTE');

            // 🧾 Identificador bancário
            $table->string('ispb')->nullable();

            // 🔄 Tipo de operação
            $table->enum('operation_type', ['PIX', 'TED'])->default('PIX');

            // 🔑 PIX
            $table->string('pix_address_key')->nullable();
            $table->enum('pix_address_key_type', ['CPF', 'CNPJ', 'EMAIL', 'PHONE', 'EVP'])->nullable();


            // 🔐 Timestamps
            $table->timestamps();

            // 🔧 Chave estrangeira (boa prática)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_withdraw_accounts');
    }
};
