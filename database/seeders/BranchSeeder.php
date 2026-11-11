<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::upsert(
            [
                [
                    'uuid' => 'd4eaa9b7-7e7b-4e8b-a686-7ceb8f601a9c',
                    'name' => 'Dammam',
                    'name_ar' => 'الدمام',
                    'code' => 'DMM',
                    'address' => 'hghghg',
                    'manager_id' => null,
                    'phone' => '0130000004',
                    'email' => 'dssdsd@ewe',
                    'logo_path' => null,
                    'stamp_path' => null,
                    'last_inspection_sequence' => 0,
                    'is_active' => true,

                ],
                [
                    'uuid' => 'a0e4641f-427f-4774-9b98-d8b5747e619f',
                    'name' => 'Jeddah',
                    'name_ar' => 'جدة',
                    'code' => 'JED',
                    'address' => 'Jeddah',
                    'manager_id' => null,
                    'phone' => '05566566655',
                    'email' => 'Tahaqoq.jeddah@gmail.com',
                    'logo_path' => null,
                    'stamp_path' => null,
                    'last_inspection_sequence' => 0,
                    'is_active' => true,

                ],
            ],
            ['code'],
            [
                'name',
                'name_ar',
                'address',
                'phone',
                'email',
                'logo_path',
                'stamp_path',
                'last_inspection_sequence',
                'is_active',
            ]

        );
    }
}
