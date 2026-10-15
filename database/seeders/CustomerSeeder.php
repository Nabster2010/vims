<?php

namespace Database\Seeders;

use App\Enums\CustomerType;
use App\Enums\IdentityType;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'customer_type' => CustomerType::INDIVIDUAL,
                'identity_type' => IdentityType::NationalID,
                'name' => 'Mohammed Al-Otaibi',
                'identity_number' => '1234567890',
                'vat_number' => null,
                'mobile' => '+966501234567',
                'email' => 'mohammed.alotaibi@email.com',
                'address' => 'Riyadh, Saudi Arabia',
                'notes' => 'Regular customer',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::INDIVIDUAL,
                'identity_type' => IdentityType::Iqama,
                'name' => 'John Smith',
                'identity_number' => '2345678901',
                'vat_number' => null,
                'mobile' => '+966502345678',
                'email' => 'john.smith@email.com',
                'address' => 'Jeddah, Saudi Arabia',
                'notes' => 'Expat customer',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::COMPANY,
                'identity_type' => IdentityType::CommercialRegistration,
                'name' => 'Al-Fahad Trading Co.',
                'identity_number' => '101012345678',
                'vat_number' => '300123456789003',
                'mobile' => '+966503456789',
                'email' => 'info@alfahad.com',
                'address' => 'Dammam, Saudi Arabia',
                'notes' => 'Corporate client - bulk inspections',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::INDIVIDUAL,
                'identity_type' => IdentityType::Passport,
                'name' => 'Abdullah Al-Qahtani',
                'identity_number' => 'A12345678',
                'vat_number' => null,
                'mobile' => '+966504567890',
                'email' => 'abdullah.qahtani@email.com',
                'address' => 'Riyadh, Saudi Arabia',
                'notes' => 'VIP customer',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::COMPANY,
                'identity_type' => IdentityType::CommercialRegistration,
                'name' => 'Gulf Automotive LLC',
                'identity_number' => '101098765432',
                'vat_number' => '300987654321003',
                'mobile' => '+966505678901',
                'email' => 'contact@gulfauto.com',
                'address' => 'Jeddah, Saudi Arabia',
                'notes' => 'Car dealership - recurring inspections',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::INDIVIDUAL,
                'identity_type' => IdentityType::NationalID,
                'name' => 'Sara Al-Mutairi',
                'identity_number' => '3456789012',
                'vat_number' => null,
                'mobile' => '+966506789012',
                'email' => 'sara.mutairi@email.com',
                'address' => 'Riyadh, Saudi Arabia',
                'notes' => 'New customer',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::COMPANY,
                'identity_type' => IdentityType::CommercialRegistration,
                'name' => 'Elite Motors Group',
                'identity_number' => '101056789012',
                'vat_number' => '300567890123003',
                'mobile' => '+966507890123',
                'email' => 'sales@elitemotors.com',
                'address' => 'Dammam, Saudi Arabia',
                'notes' => 'Premium dealership',
                'is_active' => true,
            ],
            [
                'customer_type' => CustomerType::INDIVIDUAL,
                'identity_type' => IdentityType::Iqama,
                'name' => 'Ahmed Hassan',
                'identity_number' => '4567890123',
                'vat_number' => null,
                'mobile' => '+966508901234',
                'email' => 'ahmed.hassan@email.com',
                'address' => 'Jeddah, Saudi Arabia',
                'notes' => 'Account suspended',
                'is_active' => false,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['identity_number' => $customer['identity_number']],
                $customer
            );
        }
    }
}
