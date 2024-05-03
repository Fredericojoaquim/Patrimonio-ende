<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbateVeiculo extends Model
{
    use HasFactory;
    protected $table='abate_veiculo';
    protected $guarded=[];



    public function quantidadeVeiculosAbatidos() {
        // Use a função count() do Laravel para contar o número de registros na tabela de abate
        return DB::table('abate_veiculo')->count();
    }

    public function quantidadeVeiculosAtivos() {
        // Use a função count() do Laravel para contar o número de registros na tabela de abate
        return DB::table('abate_veiculo')->count();
    }

   
}
