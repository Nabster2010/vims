<?php

namespace Database\Seeders;

use App\Models\SalesRepresentative;
use Illuminate\Database\Seeder;

class SalesRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salesRepresentatives = [
            [
                'name' => 'Ahmed Al-Rashid',
                'company_name' => 'Auto Trade Co.',
                'mobile' => '+966501234567',
                'email' => 'ahmed@autotrade.com',
                'notes' => 'Senior sales representative',
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Mohammed',
                'company_name' => 'Auto Trade Co.',
                'mobile' => '+966502345678',
                'email' => 'sarah@autotrade.com',
                'notes' => 'Handles luxury vehicle inspections',
                'is_active' => true,
            ],
            [
                'name' => 'Khalid Al-Faisal',
                'company_name' => 'Gulf Motors',
                'mobile' => '+966503456789',
                'email' => 'khalid@gulfmotors.com',
                'notes' => 'Regional representative',
                'is_active' => true,
            ],
            [
                'name' => 'Fatima Hassan',
                'company_name' => 'Elite Cars',
                'mobile' => '+966504567890',
                'email' => 'fatima@elitecars.com',
                'notes' => 'New sales representative',
                'is_active' => true,
            ],
            [
                'name' => 'Omar Ibrahim',
                'company_name' => 'Auto Trade Co.',
                'mobile' => '+966505678901',
                'email' => 'omar@autotrade.com',
                'notes' => 'On leave',
                'is_active' => false,
            ],
        ];

        foreach ($salesRepresentatives as $representative) {
            SalesRepresentative::updateOrCreate(
                ['email' => $representative['email']],
                $representative
            );
        }
    }
}
