<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
           'name'=> 'Deus' ,
            'email'=> 'theboss@gmail.com',
            'role'=> 'administrador',
            'password'=> 'adm123',

        ]);

        User::create([
            'name'=> 'Claudiane' ,
            'email'=> 'claudiane@gmail.com',
            'role'=> 'bibliotecario',
            'password'=> '123456789',

        ]);

        User::create([
            'name'=> 'Guilherme' ,
            'email'=> 'guilherme@gmail.com',
            'role'=> 'cliente',
            'password'=> '123456789',

        ]);
    }
}
