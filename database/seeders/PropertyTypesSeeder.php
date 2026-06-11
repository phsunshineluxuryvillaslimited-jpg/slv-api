<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PropertyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('property_types')->insert([
            ['name' => 'None'],
            ['name' => 'Apartment'],
            ['name' => 'Penthouse'],
            ['name' => 'Bungalow'],
            ['name' => 'Commercial Property'],
            ['name' => 'Investment Property'],
            ['name' => 'Plot'],
            ['name' => 'Studio'],
            ['name' => 'Townhouse'],
            ['name' => 'Villa'],
            ['name' => 'Penthouse Apartment'],
            ['name' => 'Land'],
            ['name' => 'Building Plot'],
            ['name' => 'Office'],
            ['name' => 'Shop']
        ]);
    }
}
