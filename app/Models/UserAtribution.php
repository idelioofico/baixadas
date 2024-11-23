<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAtribution extends Model
{
    use HasFactory;
    
    protected $table = 'user_atribution_baixada';

    protected $guarded = [];
    public $timestamps = false;
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id');
    }
}
