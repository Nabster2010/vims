<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::updateOrCreate(
            ['code' => 'DMM'],
            [
                'uuid' => (string) Str::uuid(),
                'name' => 'Dammam',
                'name_ar' => 'الدمام',
                'phone' => '0130000000',
                'last_inspection_sequence' => 0,
                'address' => "dammam"
            ]
        );
    }
}
