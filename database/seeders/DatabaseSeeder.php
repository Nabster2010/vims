<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CountrySeeder::class,
            BranchSeeder::class,
            ColorSeeder::class,
            CustomPortSeeder::class,
            CategorySeeder::class,

            ManufacturerSeeder::class,
            ModelTypeSeeder::class,

            InspectionTypeSeeder::class,
            VisualItemSeeder::class,

            SalesRepresentativeSeeder::class,
            CustomerSeeder::class,

            SuperAdminSeeder::class,
        ]);
    }
}
