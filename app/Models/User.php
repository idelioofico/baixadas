<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UsuarioSite;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_de_usuario',
        'telefone',
        'departamento',
        'mobile_access',
        'status',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function get_user_site() {
        // Query que traz todos sites relacionados a esse usuario;
        return  $user_project = UsuarioSite::where('user_id', Auth::user()->id)->pluck('site_id');
    }


    public function user_type(){
        return $this->belongsTo(TipoUsuario::class,'id');
    }

}
