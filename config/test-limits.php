<?php

use App\Enums\FuelType;

return [

    'emission' => [

        FuelType::Gasoline->value => [
            'hc' => [
                'min' => 0,
                'max' => 1200,
                'unit' => "ppm"
            ],
            'co' => [
                'min' => 0,
                'max' => 3.5,
                'unit' => "%"
            ],
            // 'lambda' => [
            //     'min' => 0.97,
            //     'max' => 1.03,
            // ],
        ],

        FuelType::Diesel->value => [
            'opacity' => [
                'min' => 0,
                'max' => 40,
                'unit' => "%"
            ]
        ],
    ],
    'headLight' => [
        'left' => [
            'min' => 0,
            'max' => 250,
            'unit' => "cd"
        ],
        'right' => [
            'min' => 0,
            'max' => 250,
            'unit' => "cd"
        ]

    ],
    'sideSlip' => [
        'value' => [
            'min' => 0,
            'max' => 7,
            'unit' => "m/km"
        ]
    ],

    'suspension' => [
        'front_left' => [
            'min' => 30,
            'max' => 100,
            'unit' => "%"
        ],
        'front_right' => [
            'min' => 30,
            'max' => 100,
            'unit' => "%"
        ],
        'rear_left' => [
            'min' => 20,
            'max' => 100,
            'unit' => "%"
        ],
        'rear_right' => [
            'min' => 20,
            'max' => 100,
            'unit' => "%"
        ]
    ],

    'brake' => [
        'front' => [
            'min' => 30,
            'max' => 100,
            'unit' => "%"
        ],
        'rear' => [
            'min' => 30,
            'max' => 100,
            'unit' => "%"
        ],
        'parking' => [
            'min' => 20,
            'max' => 100,
            'unit' => "%"
        ]
    ],


];
