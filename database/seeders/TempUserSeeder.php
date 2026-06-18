<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'user2',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user2@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user3',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user3@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user4',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user4@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user5',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user5@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user6',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user6@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user7',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user7@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user8',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user8@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user9',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user9@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user10',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user10@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user11',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user11@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],
        ]);
    }
}
