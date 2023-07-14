<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        // Create Companies using factory
        Company::factory( 10 )->create();

    }
}
