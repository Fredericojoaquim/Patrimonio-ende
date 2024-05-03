<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Veiculo extends Model
{
    use HasFactory;
    protected $table='veiculos';
    protected $guarded=[];



    public function quantidadeVeiculosAtivos() {
        // Use a função count() do Laravel para contar o número de registros na tabela de veículos com estado ativo
        return DB::table('veiculos')->where('estado', 'ativo')->count();
    }
}



