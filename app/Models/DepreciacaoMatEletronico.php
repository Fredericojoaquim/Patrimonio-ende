<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepreciacaoMatEletronico extends Model
{
    use HasFactory;
    
    protected $table='depreciacao__mat__eletronico';
    protected $guarded=[];
}
