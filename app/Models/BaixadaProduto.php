<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaixadaProduto extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function guiaSaida(){
        return $this->belongsTo(GuiaDeSaida::class,'guiaSaida_id')->where('status',1);
    }
}
