<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Filipe Marlaine Manuel Pereira',
            'username' => 'filipe402790',
            'email' => 'filipepereira977@gmail.com',
            'password' => Hash::make('filipepereiraf2mp'),
            'tipo_de_usuario' => 1,
            'telefone' => 849013127,
            'departamento' => 'Informatica',
        ]);
        // User::create([
        //     'name' => 'Samir',
        //     'email' => 'samir@gmail.com',
        //     'password' => Hash::make('password'),
        //     'tipo_de_usuario'=>3,
        //     'telefone'=>849013127,
        //     'departamento'=>'Procurement',
        // ]);
        // User::create([
        //     'name' => 'Rayhan',
        //     'email' => 'rayhan@gmail.com',
        //     'password' => Hash::make('password'),
        //     'tipo_de_usuario'=>2,
        //     'telefone'=>849013127,
        //     'departamento'=>'Procurement',
        // ]);
    }
}
