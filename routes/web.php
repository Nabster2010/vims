<?php
// web.php - Main web routes
use Illuminate\Support\Facades\Route;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\User;



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function () {

        return view('home', [

            'stats' => [

                'inspections' => Inspection::count(),

                'customers' => Customer::count(),

                'users' => User::count(),

                'branches' => Branch::count(),

                'inspectionTypes' => InspectionType::count(),

            ],

            'latestInspections' => Inspection::with([
                'customer',
                'inspectionType',
                'branch',
            ])
                ->latest()
                ->take(10)
                ->get(),

            'branches' => Branch::withCount('inspections')
                ->orderBy('name')
                ->get(),

            'inspectionTypes' => InspectionType::withCount('inspections')
                ->orderBy('name')
                ->get(),

        ]);
    })->name('home');
    require __DIR__ . '/dashboard.php';
    require __DIR__ . '/customers.php';
    require __DIR__ . '/inspections.php';
    require __DIR__ . '/administration.php';
    require __DIR__ . '/users.php';
    require __DIR__ . '/reports.php';
});

require __DIR__ . '/settings.php';
