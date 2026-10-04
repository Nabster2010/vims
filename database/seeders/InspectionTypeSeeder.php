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

                'prefix' => 'IMP',

            ],

            [

                'code' => 'SBG',

                'name' => 'Saber - Gasoline & Diesel Vehicle Inspection',

                'prefix' => 'SBG',

            ],

            [

                'code' => 'SBE',

                'name' => 'Saber - EV / HEV Vehicle Inspection',

                'prefix' => 'SBE',

            ],

            [

                'code' => 'MDL',

                'name' => 'Modified Vehicle Inspection (< 3500 kg)',

                'prefix' => 'MDL',

            ],

            [

                'code' => 'MDH',

                'name' => 'Modified Vehicle Inspection (> 3500 kg)',

                'prefix' => 'MDH',

            ],

            [

                'code' => 'MTC',

                'name' => 'Motorcycle Inspection',

                'prefix' => 'MTC',

            ],

        ];
        foreach ($types as $type) {

            InspectionType::create($type);

        }
    }
}
