<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agents')->insert([
            [
                'first_name' => 'Agent',
                'last_name' => 'One',
                'email' => 'agentOne@sample.com',
                'phone_number' => '123123123',
                'mobile_number' => '341212312',
            ],
            [
                'first_name' => 'Agent',
                'last_name' => 'Two',
                'email' => 'agent_two@sample.com',
                'phone_number' => '1231234123',
                'mobile_number' => '341234312',
            ],
            [
                'first_name' => 'Agent',
                'last_name' => 'three',
                'email' => 'agent_three@sample.com',
                'phone_number' => '12123423123',
                'mobile_number' => '341wer2312',
            ],
        ]);
    }
}
