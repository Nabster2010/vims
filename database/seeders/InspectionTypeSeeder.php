<?php

namespace Database\Seeders;

use App\Models\InspectionType;
use Illuminate\Database\Seeder;

class InspectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [

            [

                'code' => 'IMP',

                'name' => 'Imported Vehicle Inspection',
                'name_ar' => 'سيارات مستوردة',
                'prefix' => 'IMP',

            ],

            [

                'code' => 'SBR',
                'name' => 'Saber - Vehicle Inspection',
                'name_ar' => 'فحص مركبة - منصة سابر',
                'prefix' => 'SBR',

            ],

            [

                'code' => 'MDL',

                'name' => 'Modified Vehicle Inspection (< 3500 kg)',
                'name_ar' => 'سيارات معدلة اقل من 3500',
                'prefix' => 'MDL',

            ],

            [

                'code' => 'MDH',

                'name' => 'Modified Vehicle Inspection (> 3500 kg)',
                'name_ar' => 'سيارات معدلة اكبر من 3500',

                'prefix' => 'MDH',

            ],

            [

                'code' => 'MTC',

                'name' => 'Motorcycle Inspection',
                'name_ar' => 'دراجات نارية',
                'prefix' => 'MTC',

            ],
            [

                'code' => 'TRL',

                'name' => 'Trailers Inspection',
                'name_ar' => 'فحص مقطورات ونصف المقطورات',
                'prefix' => 'TRL',

            ],

        ];
        foreach ($types as $type) {

            InspectionType::create($type);
        }
    }
}
