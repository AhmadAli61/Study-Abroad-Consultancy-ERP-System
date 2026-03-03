<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insert([
            [
                'username' => 'admin1',
                'password' => 'adminpass',
                'role' => 'admin'
            ],
            [
                'username' => 'manager1',
                'password' => 'managerpass',
                'role' => 'manager'
            ],
            [
                'username' => 'counsellor1',
                'password' => 'counsellorpass',
                'role' => 'counsellor'
            ],
             [
                'username' => 'admission1',
                'password' => 'admissionpass',
                'role' => 'admission'
            ],
            [
                'username' => 'admissionagent1',
                'password' => 'admissionagentpass',
                'role' => 'admissionagent'
            ],
            [
                 'username' => 'externalagent1',
                'password' => 'externalagentispass',
                'role' => 'externalagent' 
            ]
        ]);
    }
}
