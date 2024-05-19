<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaterialEscritorioModel extends Model
{
    use HasFactory;
    protected $table='materialescritorio';
    protected $guarded=[];

    public function quantidadeMaterialEscritorioAtivos() {
        // Use a função count() do Laravel para contar o número de registros na tabela de veículos com estado ativo
        return DB::table('materialescritorio')->where('estado', 'ativo')->count();
    }
}
