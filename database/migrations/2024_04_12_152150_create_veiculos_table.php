<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula');
            $table->string('numero_chassi');
            $table->string('num_motor');
            $table->string('tipo_caixavelocidade');
            $table->date('data_fabrico');
            $table->date('dataAquisicao');
            $table->string('tipo_aquisicao');
            $table->string('tipo_combustivel');
            $table->string('cor');
            $table->string('tipo_veiculo');
            $table->double('custo_aquisicao_kz')->nullable();
            $table->double('custo_aquisicao_usd')->nullable();
            $table->double('custo_aquisicao_euro')->nullable();
            $table->string('nome_segurador')->nullable();
            $table->string('cobertura')->nullable();
            $table->double('valor_seguro')->nullable();
            $table->string('apolice')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('estado'); 
            $table->double('valor_residual')->nullable();
            $table->bigInteger('vida_util')->nullable();
            $table->bigInteger('tiposguro_id')->nullable();
            $table->date('data_utilizacao');
            $table->foreign('tiposguro_id')->references('id')->on('tiposeguro');
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
        Schema::dropIfExists('veiculos');
    }
}
