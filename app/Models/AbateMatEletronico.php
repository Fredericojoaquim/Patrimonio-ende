<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbateMatEletronico extends Model
{
    use HasFactory;
    protected $table='abate_materialeletronico';
    protected $guarded=[];
}
