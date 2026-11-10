<?php
// web.php - Main web routes
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\User;
use App\Enums\UserRole;



Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/', function () {

        $userQuery =  User::query();

        $inspectionQuery = Inspection::query();

        if (Auth::user()->role !== UserRole::SuperAdmin) {
            $inspectionQuery->where('branch_id', Auth::user()->branch_id);
        }
        if (Auth::user()->role !== UserRole::SuperAdmin) {
            $userQuery->where('branch_id', Auth::user()->branch_id);
        }


        return view('home', [

            'stats' => [

                'inspections'     => (clone $inspectionQuery)->count(),
                'customers'       => Customer::count(),
                'users'           => (clone $userQuery)->count(),
                'branches'        => Branch::count(),
                'inspectionTypes' => InspectionType::count(),

            ],

            'latestInspections' => (clone $inspectionQuery)
                ->with([
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
