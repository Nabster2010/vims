<?php

namespace App\Providers;

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
use App\Policies\BranchPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ColorPolicy;
use App\Policies\CountryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\CustomPortPolicy;
use App\Policies\InspectionPolicy;
use App\Policies\InspectionTypePolicy;
use App\Policies\ManufacturerPolicy;
use App\Policies\ModelTypePolicy;
use App\Policies\SalesRepresentativePolicy;
use App\Policies\UserPolicy;
use App\Policies\VisualItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Branch::class => BranchPolicy::class,
        Category::class => CategoryPolicy::class,
        Color::class => ColorPolicy::class,
        Country::class => CountryPolicy::class,
        Customer::class => CustomerPolicy::class,
        CustomPort::class => CustomPortPolicy::class,
        Inspection::class => InspectionPolicy::class,
        InspectionType::class => InspectionTypePolicy::class,
        Manufacturer::class => ManufacturerPolicy::class,
        ModelType::class => ModelTypePolicy::class,
        SalesRepresentative::class => SalesRepresentativePolicy::class,
        User::class => UserPolicy::class,
        VisualItem::class => VisualItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function register(): void
    {
        //
    }
}
