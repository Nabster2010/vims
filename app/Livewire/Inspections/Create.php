<?php

namespace App\Livewire\Inspections;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Inspection')]
class Create extends Component
{
    public string $vin = '';

}
