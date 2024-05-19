<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaterialElectronico extends Model
{
    use HasFactory;
    protected $table='materiaeletronico';
    protected $guarded=[];

    public function quantidadeMaterialEletronicoAtivos() {
        // Use a função count() do Laravel para contar o número de registros na tabela de veículos com estado ativo
        return DB::table('materiaeletronico')->where('estado', 'ativo')->count();
    }
    
}
