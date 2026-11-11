<?php

use App\Enums\FuelType;

return [

    'emission' => [

        FuelType::Gasoline->value => [
            'hc' => [
                'min' => 0,
                'max' => 1200,
                'unit' => 'ppm',
                'label' => 'Emission Hydrocarbons',
            ],
            'co' => [
                'min' => 0,
                'max' => 3.5,
                'unit' => '%',
                'label' => 'Emission Carbon Monoxide',
            ],

        ],
        FuelType::Hybrid->value => [
            'hc' => [
                'min' => 0,
                'max' => 1200,
                'unit' => 'ppm',
                'label' => 'Emission Hydrocarbons',
            ],
            'co' => [
                'min' => 0,
                'max' => 3.5,
                'unit' => '%',
                'label' => 'Emission Carbon Monoxide',
            ],

        ],
        FuelType::Phev->value => [
            'hc' => [
                'min' => 0,
                'max' => 1200,
                'unit' => 'ppm',
                'label' => 'Emission Hydrocarbons',
            ],
            'co' => [
                'min' => 0,
                'max' => 3.5,
                'unit' => '%',
                'label' => 'Emission Carbon Monoxide',
            ],

        ],

        FuelType::Diesel->value => [
            'opacity' => [
                'min' => 0,
                'max' => 40,
                'unit' => '%',
                'label' => 'Diesel Opacity',
            ],
        ],
    ],
    'headLight' => [
        'left' => [
            'min' => 0,
            'max' => 250,
            'unit' => 'cd',
            'label' => 'Head Light Left',
        ],
        'right' => [
            'min' => 0,
            'max' => 250,
            'unit' => 'cd',
            'label' => 'Head Light Right',
        ],

    ],
    'sideSlip' => [
        'value' => [
            'min' => 0,
            'max' => 7,
            'unit' => 'm/km',
            'label' => 'Side Slip',
        ],
    ],

    'suspension' => [
        'front_left' => [
            'min' => 30,
            'max' => 100,
            'unit' => '%',
            'label' => 'Suspension Front Left',
        ],
        'front_right' => [
            'min' => 30,
            'max' => 100,
            'unit' => '%',
            'label' => 'Suspension Front Right',
        ],
        'rear_left' => [
            'min' => 20,
            'max' => 100,
            'unit' => '%',
            'label' => 'Suspension Rear Left',
        ],
        'rear_right' => [
            'min' => 20,
            'max' => 100,
            'unit' => '%',
            'label' => 'Suspension Rear Right',
        ],
    ],

    'brake' => [
        'front' => [
            'min' => 30,
            'max' => 100,
            'unit' => '%',
            'label' => 'Brake Front',
        ],
        'rear' => [
            'min' => 30,
            'max' => 100,
            'unit' => '%',
            'label' => 'Brake Rear',
        ],
        'parking' => [
            'min' => 20,
            'max' => 100,
            'unit' => '%',
            'label' => 'Brake Parking',
        ],
    ],

];
