<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::insert(
            'INSERT INTO users (name, email, password, role_id, company_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)',
            ['Super Admin', 'superadmin@example.com', \Illuminate\Support\Facades\Hash::make('password'), 1, null, now(), now()]
        );
    }
}
