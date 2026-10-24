<?php

use App\Models\Branch;
use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomPort;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\Manufacturer;
use App\Models\ModelType;
use App\Models\SalesRepresentative;
use App\Models\User;
use App\Models\VisualItem;

return [

    'sidebar' => [

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        [
            'heading' => 'Dashboard',

            'items' => [

                [
                    'label' => 'Dashboard',
                    'icon' => 'home',
                    'route' => 'dashboard',
                ],

            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Operations
        |--------------------------------------------------------------------------
        */

        [
            'heading' => 'Operations',

            'items' => [

                [
                    'label' => 'Inspections',
                    'icon' => 'clipboard-document-list',
                    'route' => 'inspections.index',
                    'active' => ['inspections.*'],
                    'can' => [
                        'viewAny',
                        Inspection::class,
                    ],
                ],
                [
                    'label' => 'Customers',
                    'icon' => 'users',
                    'route' => 'customers.index',
                    'active' => ['customers.*'],
                    'can' => [
                        'viewAny',
                        Customer::class,
                    ],
                ],

            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Master Data
        |--------------------------------------------------------------------------
        */

        [
            'heading' => 'Master Data',

            'items' => [

                [
                    'label' => 'Colors',
                    'icon' => 'swatch',
                    'route' => 'administration.colors.index',
                    'active' => ['administration.colors.*'],
                    'can' => [
                        'viewAny',
                        Color::class,
                    ],
                ],

                [
                    'label' => 'Manufacturers',
                    'icon' => 'building-office',
                    'route' => 'administration.manufacturers.index',
                    'active' => ['administration.manufacturers.*'],
                    'can' => [
                        'viewAny',
                        Manufacturer::class,
                    ],
                ],

                [
                    'label' => 'Model Types',
                    'icon' => 'rectangle-group',
                    'route' => 'administration.model-types.index',
                    'active' => ['administration.model-types.*'],
                    'can' => [
                        'viewAny',
                        ModelType::class,
                    ],
                ],

            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | System
        |--------------------------------------------------------------------------
        */

        [
            'heading' => 'System',

            'items' => [

                [
                    'label' => 'Users',
                    'icon' => 'user',
                    'route' => 'users.index',
                    'can' => [
                        'viewAny',
                        User::class,
                    ],
                ],

                [
                    'label' => 'Branches',
                    'icon' => 'building-office',
                    'route' => 'administration.branches.index',
                    'active' => ['administration.branches.*'],
                    'can' => [
                        'viewAny',
                        Branch::class,
                    ],
                ],

                [
                    'label' => 'Inspection Types',
                    'icon' => 'clipboard-document-list',
                    'route' => 'administration.inspection-types.index',
                    'active' => ['administration.inspection-types.*'],
                    'can' => [
                        'viewAny',
                        InspectionType::class,
                    ],
                ],

                [
                    'label' => 'Categories',
                    'icon' => 'folder',
                    'route' => 'administration.categories.index',
                    'active' => ['administration.categories.*'],
                    'can' => [
                        'viewAny',
                        Category::class,
                    ],
                ],

                [
                    'label' => 'Visual Items',
                    'icon' => 'eye',
                    'route' => 'administration.visual-items.index',
                    'active' => ['administration.visual-items.*'],
                    'can' => [
                        'viewAny',
                        VisualItem::class,
                    ],
                ],
                [
                    'label' => 'Countries',
                    'icon' => 'map-pin',
                    'route' => 'administration.countries.index',
                    'active' => ['administration.countries.*'],
                    'can' => [
                        'viewAny',
                        Country::class,
                    ],
                ],
                [
                    'label' => 'Sales Representatives',
                    'icon' => 'user-group',
                    'route' => 'administration.sales-representatives.index',
                    'active' => ['administration.sales-representatives.*'],
                    'can' => [
                        'viewAny',
                        SalesRepresentative::class,
                    ],
                ],
                [
                    'label' => 'Custom Ports',
                    'icon' => 'building-storefront',
                    'route' => 'administration.custom-ports.index',
                    'active' => ['administration.custom-ports.*'],
                    'can' => [
                        'viewAny',
                        CustomPort::class,
                    ],
                ],

            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Reports
        |--------------------------------------------------------------------------
        */

        [
            'heading' => 'Reports',

            'items' => [

                [
                    'label' => 'Reports',
                    'icon' => 'chart-bar',
                    'route' => 'reports.index',
                    'active' => ['reports.*'],
                ],

            ],
        ],

    ],

];
