<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'name'=>'Weza Celsio',
            'email'=>'kizalusoft@gmail.com',
            'isAdmin'=>1,
            'password'=>bcrypt(123456789)
        ]);
    }
}
