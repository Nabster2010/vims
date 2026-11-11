<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use Illuminate\Support\Str;
use Livewire\Form;

class BranchForm extends Form
{
    public $name;

    public $name_ar;

    public $code;

    public $address;

    public $phone;

    public $email;

    public $manager_id;

    public $is_active;

    public function fillFromBranch($branch)
    {
        $this->name = $branch->name;
        $this->name_ar = $branch->name_ar;
        $this->code = $branch->code;
        $this->address = $branch->address;
        $this->phone = $branch->phone;
        $this->email = $branch->email;
        $this->manager_id = $branch->manager_id;
        $this->is_active = $branch->is_active;
    }

    public function rules(?Branch $branch = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:20',

            ],

            'address' => [
                'nullable',
                'string',
                'required',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'manager_id' => [
                'nullable',
                'exists:users,id',
            ],

            'is_active' => [
                'boolean',
            ],

        ];
    }

    public function data(): array
    {
        return [

            'name' => $this->name,

            'name_ar' => $this->name_ar,

            'code' => $this->code,

            'address' => $this->address,

            'phone' => $this->phone,

            'email' => $this->email,

            'manager_id' => $this->manager_id,

            'is_active' => $this->is_active,

        ];
    }

    public function save(Branch $branch): void
    {
        $this->validate(
            $this->rules($branch)
        );
        $branch->update(
            $this->data()
        );
    }

    public function create(): Branch
    {
        $this->validate($this->rules());

        return Branch::create([
            ...$this->data(),
            'uuid' => Str::uuid(),
        ]);
    }
}
