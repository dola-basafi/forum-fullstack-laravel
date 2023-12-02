<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    
   
    $data = [
      [
        'name' => 'admin',
        'email' => 'admin@mail.com',
        'address' => 'dago',
        'phone' => '1331',
        'password' => bcrypt('qweewqasd'),
        'role' => 1
      ], [
        'name' => 'user',
        'email' => 'user@mail.com',
        'address' => 'braga',
        'phone' => '14141',
        'password' => bcrypt('qweewqasd'),
        'role' => 2
      ], [
        'name' => 'user1',
        'email' => 'user1@mail.com',
        'address' => 'braga',
        'phone' => '141413',
        'password' => bcrypt('qweewqasd'),
        'role' => 2
      ]
    ];
    DB::table('users')->insert($data);
  }
}
