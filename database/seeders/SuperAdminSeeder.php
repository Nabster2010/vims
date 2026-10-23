<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'admin@vims.test',
            ],
            [
                'name' => 'Super Administrator',

                'employee_no' => 'EMP-0001',

                'password' => 'Admin@123',

                'role' => UserRole::SuperAdmin,

                'status' => UserStatus::Active,

                'force_password_change' => true,
            ]
        );
    }
}
