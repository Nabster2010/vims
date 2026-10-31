<?php

namespace App\Services\Reports;

use App\Models\Branch;
use App\Models\Inspection;
use App\Services\DateService;

class ImportedVehicleReportService
{
    public function build(Inspection $inspection): Inspection
    {
        $inspection =  $inspection->loadMissing([
            'branch.manager',
            'customer',
            'customPort',
            'inspectionType',
            'vehicleInformation',
            'visualInspection.visualItemResults',
            'brakeInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'emissionInspection',
            'photos'
        ]);

        $data =  [
            'branch_name' => $inspection->branch->name,
            'report_no' => $inspection->reportNo,
            'report_date_gregorian' => app(DateService::class)->gregorian($inspection->created_at),
            'report_date_hijri' => app(DateService::class)->hijri($inspection->created_at),
            'report_title' => 'تقرير فحص مركبة مستوردة',
            'inspection_place' => "مختبر التحقق الدولية لفحص السيارات" . " - " . $inspection->branch->name_ar,
            'custom_declaration_no' => $inspection->custom_declaration_no,
            'custom_declaration_date' => $inspection->custom_declaration_date ? app(DateService::class)->hijri($inspection->custom_declaration_date) : null,
            'request_no' => $inspection->request_no,
            'request_date' => $inspection->request_date ? app(DateService::class)->gregorian($inspection->request_date) : null,
            'manager_name' => $inspection->branch->manager->name,
            'customer_name' => $inspection->customer->name,
            'custom_port_name' => $inspection->customPort->name_ar,
            'no_of_seats' => $inspection->vehicleInformation->number_of_seats,
            'mileage' => $inspection->vehicleInformation->mileage,
            'manufacturer' => $inspection->vehicleInformation->manufacturer->name,
            'model_type' => $inspection->vehicleInformation->modelType->name,
            'model_year' => $inspection->vehicleInformation->model_year,
            'color' => $inspection->vehicleInformation->color->name_ar ?? '',
            'origin_country' => $inspection->vehicleInformation->originCountry->name_ar ?? '',
            'final_result' => $inspection->final_result ?? '',
            'inspection_type' => $inspection->inspectionType,
            'vehicle_information' => $inspection->vehicleInformation,
            'visual_inspection' => $inspection->visualInspection,
            'brake_inspection' => $inspection->brakeInspection,
            'head_light_inspection' => $inspection->headLightInspection,
            'side_slip_inspection' => $inspection->sideSlipInspection,
            'suspension_inspection' => $inspection->suspensionInspection,
            'emission_inspection' => $inspection->emissionInspection,
            'photos' => $inspection->photos,
        ];



        return $inspection;
    }
}
