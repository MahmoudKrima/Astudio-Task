<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'first_name' => 'Mahmoud',
            'last_name' => 'Krima',
            'email' => 'modykrima2000@gmail.com',
            'password' => '123456789',
        ]);

        $user2 = User::create([
            'first_name' => 'Krima',
            'last_name' => 'Mahmoud',
            'email' => 'krimamody2000@gmail.com',
            'password' => '123456789',
        ]);

        cache()->put('user1', $user1->id);
        cache()->put('user2', $user2->id);
    }
}
