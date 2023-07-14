<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        // Create Admin
        $admin = \App\Models\User::create( [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt( 'password' ),
        ] );

        // Assign Admin Role
        $admin->assignRole( 'admin' );
    }
}
