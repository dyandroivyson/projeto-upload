<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArquivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->bigIncrements('arquivo_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::create('arquivo_files', function (Blueprint $table) {
            $table->bigIncrements('arquivo_file_id');
            $table->string('nome_arquivo');
            $table->string('tamanho');
            $table->unsignedBigInteger('arquivo_id');
            $table->timestamps();

            $table->foreign('arquivo_id')->references('arquivo_id')
                ->on('arquivos')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::create('arquivo_users', function (Blueprint $table) {
            $table->unsignedBigInteger('arquivo_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('arquivo_id')->references('arquivo_id')
                ->on('arquivos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');

            $table->primary(['arquivo_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivo_users');
        Schema::dropIfExists('arquivo_files');
        Schema::dropIfExists('arquivos');
    }
}
