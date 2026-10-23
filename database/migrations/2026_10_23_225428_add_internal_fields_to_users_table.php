<?php

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->uuid('uuid')
                ->after('id')
                ->nullable()
                ->unique();

            $table->string('employee_no')
                ->nullable()
                ->after('email');

            $table->string('role')
                ->default(UserRole::Receptionist->value)
                ->after('password');

            $table->string('status')
                ->default(UserStatus::Active->value)
                ->after('role');

            $table->boolean('force_password_change')
                ->default(true)
                ->after('status');

            $table->timestamp('last_login_at')
                ->nullable()
                ->after('force_password_change');

            $table->string('last_login_ip')
                ->nullable()
                ->after('last_login_at');

            $table->foreignId('created_by')
                ->nullable()
                ->after('last_login_ip')
                ->constrained('users')
                ->nullOnDelete();
        });

        DB::table('users')->get()->each(function ($user) {

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'uuid' => (string) Str::uuid(),
                ]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropConstrainedForeignId('created_by');

            $table->dropColumn([
                'uuid',
                'employee_no',
                'role',
                'status',
                'force_password_change',
                'last_login_at',
                'last_login_ip',
            ]);
        });
    }
};
