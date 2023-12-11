<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcampos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edificio', function (Blueprint $table) {
            $table->double('custo_aquisicao_usd')->nullable();
            $table->double('custo_aquisicao_euro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('edificio', function (Blueprint $table) {
            //
        });
    }
}
