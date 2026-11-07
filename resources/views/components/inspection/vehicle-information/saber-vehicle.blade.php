            <x-inspection.vehicle-information.saber.general-information />
            <x-inspection.vehicle-information.saber.powertrain />
            <x-inspection.vehicle-information.saber.dimensions />
            <x-inspection.vehicle-information.saber.braking />
            @if (in_array($this->form->fuel_type, [\App\Enums\FuelType::Phev, \App\Enums\FuelType::Ev]))
                <x-inspection.vehicle-information.saber.electric />
            @endif
            <x-inspection.vehicle-information.saber.compliance />
