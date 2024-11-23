<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
class Agrp_viaturas extends Model
{
    use HasFactory;

    
    protected $guarded=[];

    protected $table = 'agrp_viaturas';
    public $timestamps = false;
}
