<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residencia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('endereco_id')->unsigned();
            $table->string('num_imobilizado');
            $table->string('descricao');
            $table->double('valor_aquisicao')->nullable();;
            $table->double('custo_aquisicao_usd')->nullable();
            $table->double('custo_aquisicao_euro')->nullable();
            $table->string('finalidade');
            $table->string('tipo_aquisicao');
            $table->date('data_aquisicao');
            $table->string('dimensao');
            $table->string('estado');
            $table->bigInteger('num_compartimento');
            $table->double('valor_residual')->nullable();
            $table->bigInteger('vida_util')->nullable();
            $table->date('data_utilizacao');
            $table->foreign('endereco_id')->references('id')->on('endereco');
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
        Schema::dropIfExists('residencia');
    }
}
