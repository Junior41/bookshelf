<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplars', function (Blueprint $table) {
            $table->id();
            $table->integer("estadoConservacao");
            $table->boolean("emprestado")->default(0);
            $table->date("dataEntrega")->nullable();

            $table->string("codigo");
            $table->string("CPFSocio")->nullable();
            $table->string("CNPJFornecedor")->nullable();

            $table->foreign('CPFSocio')->references('CPF')->on('socios')->onDelete('cascade');
            $table->foreign('CNPJFornecedor')->references('CNPJ')->on('fornecedors')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exemplars');
    }
};
