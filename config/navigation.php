<?php

return [

    'sidebar' => [

        [
            'heading' => 'Main',

            'items' => [

                [
                    'label' => 'Dashboard',
                    'icon' => 'home',
                    'route' => 'dashboard',
                ],

            ],
        ],

        [
            'heading' => 'Reception',

            'items' => [

                [
                    'label' => 'Customers',
                    'icon' => 'users',
                    'route' => 'customers.index',
                    'active' => ['customers.*',]
                ],

                [
                    'label' => 'Inspections',
                    'icon' => 'clipboard-document-list',
                    'route' => 'inspections.index',
                    'active' => ['inspections.*',],
                ],

            ],
        ],

        [
            'heading' => 'Administration',

            'items' => [

                [
                    'label' => 'Branches',
                    'icon' => 'building-office',
                    'route' => 'administration.branches.index',
                ],
                [
                    'label' => 'Inspection Types',
                    'icon' => 'clipboard-document-list',
                    'route' => 'administration.inspection-types.index',
                ],
                [
                    'label' => 'Categories',
                    'icon' => 'folder',
                    'route' => 'administration.categories.index',
                ],
                [
                    'label' => 'Visual Items',
                    'icon' => 'eye',
                    'route' => 'administration.visual-items.index',
                ],
                [
                    'label' => 'Colors',
                    'icon' => 'swatch',
                    'route' => 'administration.colors.index',
                ],
                [
                    'label' => 'Sales Representatives',
                    'icon' => 'user-group',
                    'route' => 'administration.sales-representatives.index',
                ],
                [
                    'label' => 'Countries',
                    'icon' => 'map-pin',
                    'route' => 'administration.countries.index',
                ],
                [
                    'label' => 'Manufacturers',
                    'icon' => 'building-office',
                    'route' => 'administration.manufacturers.index',
                ],
                [
                    'label' => 'Model Types',
                    'icon' => 'rectangle-group',
                    'route' => 'administration.model-types.index',
                ],
                [
                    'label' => 'Custom Ports',
                    'icon' => 'building-storefront',
                    'route' => 'administration.custom-ports.index',
                ],

            ],
        ],
        [
            'heading' => 'Users',

            'items' => [

                [
                    'label' => 'Users',
                    'icon' => 'user',
                    'route' => 'users.index',
                ],

            ],
        ],
        [
            'heading' => 'Reports',

            'items' => [

                [
                    'label' => 'Reports',
                    'icon' => 'chart-bar',
                    'route' => 'reports.index',
                ],

            ],
        ],

    ],

];
