<?php

namespace App\Services;

use App\Models\ImportedVehicleRegistration;
use App\Models\Inspection;

class ImportedVehicleRegistrationService
{

    public function create(
        Inspection $inspection,
        array $data
    ) {



        if ($inspection->importedVehicleRegistration()->exists()) {
            throw new \LogicException(
                'Registration already exists for this inspection.'
            );
        }



        return $inspection->importedVehicleRegistration()->create([

            'request_no' => $data['request_no'],

            'request_date' => $data['request_date'],

            'custom_declaration_no' => $data['custom_declaration_no'],

            'custom_declaration_date' => $data['custom_declaration_date'],

            'custom_port_id' => $data['custom_port_id'],

            'payment_type' => $data['payment_type'],

        ]);
    }
}
