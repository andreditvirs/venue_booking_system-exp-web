<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->username = 'AdminVenue';
        $user->password = Hash::make('AdminVenue');
        $user->role = 'admin';
        $user->save();

        $user = new User;
        $user->username = 'UserVenue';
        $user->password = Hash::make('UserVenue');
        $user->role = 'users';
        $user->save();
    }
}
