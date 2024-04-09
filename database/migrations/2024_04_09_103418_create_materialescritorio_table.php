<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialescritorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialescritorio', function (Blueprint $table) {
            $table->id();
            $table->string('num_mobilizado');
            $table->string('descricao');
            $table->double('valor_aquisicao')->nullable();
            $table->double('custo_aquisicao_usd')->nullable();
            $table->double('custo_aquisicao_euro')->nullable();
            $table->string('finalidade');
            $table->string('tipo_aquisicao');
            $table->date('data_aquisicao');
            $table->date('data_utilizacao');
            $table->string('estado');
            $table->string('cor');
            $table->string('marca');
            $table->string('tipo');
            $table->bigInteger('vida_util')->nullable();
            $table->double('valor_residual')->nullable();
            $table->bigInteger('fornecedor_id')->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedor');
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
        Schema::dropIfExists('materialescritorio');
    }
}
