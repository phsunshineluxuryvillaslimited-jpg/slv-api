<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
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
                'first_name' => 'Admin',
                'last_name' => 'Support',
                'role_id' => 1,
                'email' => 'admin@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Paul',
                'last_name' => 'Hann',
                'role_id' => 1,
                'email' => 'paul@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Vita',
                'last_name' => 'Phillips',
                'role_id' => 1,
                'email' => 'vita@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Yulia',
                'last_name' => 'Stanislavchuk',
                'role_id' => 1,
                'email' => 'yulia@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Cheryl',
                'last_name' => 'Hann',
                'role_id' => 2,
                'email' => 'cheryl@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Jake',
                'last_name' => 'Oliver',
                'role_id' => 2,
                'email' => 'jake@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Scott',
                'last_name' => 'Toulson',
                'role_id' => 2,
                'email' => 'scott@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Nicole',
                'last_name' => 'Jacobson',
                'role_id' => 2,
                'email' => 'nicole@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Jasmin',
                'last_name' => 'Jacobsen',
                'role_id' => 2,
                'email' => 'jasmin@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Gabbie',
                'last_name' => 'Simpson',
                'role_id' => 2,
                'email' => 'gabbie@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'Iryna',
                'last_name' => 'Siryk',
                'role_id' => 2,
                'email' => 'iryna@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('12345678'),
            ],
            [
                'company' => 'slv',
                'first_name' => 'SLV',
                'last_name' => 'General',
                'role_id' => 5,
                'email' => 'slvgen@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('1(cd564^8x'),
            ],
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
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],[
                'company' => 'slv',
                'first_name' => 'user1',
                'last_name' => 'temp',
                'role_id' => 1,
                'email' => 'user1@sunshineluxuryvillas.co.uk',
                'password' => bcrypt('tmp123'),
            ],
        ]);
    }
}
