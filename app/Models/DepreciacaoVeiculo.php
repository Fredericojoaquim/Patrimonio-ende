<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepreciacaoVeiculo extends Model
{
    use HasFactory;
    
    protected $table='depreciacao_veiculo';
    protected $guarded=[];
}
