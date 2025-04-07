<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
           'name' => 'admin smk',
           'email' => 'adminsmk@gmail.com',
           'password' => Hash::make('adminsmk098'),
           'role' => 'admin',
           'created_at' => now(),
           'updated_at' => now(),
    ]);

         DB::table('users')->insert([
           'name' => 'Dev PKL',
           'email' => 'developerpklsmkn1kraksaan@gmail.com',
           'password' => Hash::make('admindevpkl'),
           'role' => 'admin',
           'created_at' => now(),
           'updated_at' => now(),
    ]);
  } 
}
