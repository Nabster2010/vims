<?php

namespace App\Livewire\Forms;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class UserForm extends Form
{
    public ?int $branch_id;

    public string $name;

    public string $employee_no;

    public string $email;

    public ?string $password = null;

    public UserRole $role;

    public UserStatus $status;

    public bool $force_password_change = true;

    public function fillFromUser(User $user): void
    {
        $this->branch_id = $user->branch_id;

        $this->name = $user->name;

        $this->employee_no = $user->employee_no;

        $this->email = $user->email;

        $this->role = $user->role;

        $this->status = $user->status;

        $this->force_password_change = $user->force_password_change;
    }

    public function rules(?User $user = null): array
    {
        return [

            'branch_id' => [
                'nullable',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'employee_no' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'employee_no')
                    ->ignore($user),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user),
            ],

            'password' => [
                $user ? 'nullable' : 'required',
                'string',
                'min:8',
            ],

            'role' => [
                'required',
                new Enum(UserRole::class),
            ],

            'status' => [
                'required',
                new Enum(UserStatus::class),
            ],

            'force_password_change' => [
                'boolean',
            ],

        ];
    }

    public function data(): array
    {
        $data = [

            'branch_id' => $this->branch_id,

            'name' => $this->name,

            'employee_no' => $this->employee_no,

            'email' => $this->email,

            'role' => $this->role,

            'status' => $this->status,

            'force_password_change' => $this->force_password_change,

        ];

        if (filled($this->password)) {
            $data['password'] = $this->password;
        }

        return $data;
    }

    public function save(User $user): void
    {
        $this->validate(
            $this->rules($user)
        );

        $user->update(
            $this->data()
        );
        $this->password = null;
    }

    public function create(): User
    {
        $this->validate(
            $this->rules()
        );

        $user = User::create(
            $this->data()
        );
        $this->password = null;

        return $user;
    }
}
