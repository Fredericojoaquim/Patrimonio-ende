<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoAbate extends Model
{
    use HasFactory;
    
    protected $table='motivos_abate';
    protected $guarded=[];
}
