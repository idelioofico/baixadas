<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
use Auth;

class UsuarioProjecto extends Model
{
    use HasFactory;

    protected $table = 'usuario_projectos';

    function get_user_projects() {
        // Query que traz todos projectos relacionados a esse usuario;
        return  $user_project = $this::where('user_id', Auth::user()->id)->pluck('projecto_id');
    }

    function get_user_sites() {
        // Query que traz todos projectos relacionados a esse usuario;
        $projects = $this::where('user_id', Auth::user()->id)->pluck('projecto_id');
        return $sites = DB::table('usuario_sites')->where('user_id', Auth::user()->id)->pluck('site_id');
        // return  DB::table('site')->whereIn('id', $sites)->pluck('id');
    }

}
