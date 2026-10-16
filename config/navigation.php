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
