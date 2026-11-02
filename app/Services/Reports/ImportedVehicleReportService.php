<?php

namespace App\Services\Reports;

use App\Enums\PhotoType;
use App\Models\Inspection;

class ImportedVehicleReportService
{
    public function build(Inspection $inspection): array
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
            'photos' => fn($query) => $query->whereIn('photo_type', [
                PhotoType::FRONT,
                PhotoType::REAR,
                PhotoType::LEFT,
                PhotoType::RIGHT,
                PhotoType::VIN,
                PhotoType::ODOMETER,
            ]),
        ]);
        $visualInspection = $inspection->visualInspection->visualItemResults;
        $visualInspectionGroups = $visualInspection->load('visualItem')->groupBy(fn($result) => $result->visualItem->category);
        $leftCategories = ['internal', 'interior', 'safety', 'modern_systems', 'fuel_economy', 'other'];

        $reportData =  [
            'report_title' => 'تقرير فحص مركبة مستوردة',
            'report_no' => $inspection->reportNo,
            'inspection_type_code' => $inspection->inspectionType->code,
            'report_date_gregorian' => app(\App\Services\DateService::class)->gregorian($inspection->created_at),
            'report_date_hijri' => app(\App\Services\DateService::class)->hijri($inspection->created_at),
            'branch_code' => $inspection->branch->code,
            'branch_name' => $inspection->branch->name,
            'branch_name_ar' => $inspection->branch->name_ar,
            'vin' => $inspection->vin,
            'number_of_seats' => $inspection->vehicleInformation->number_of_seats,
            'mileage' => $inspection->vehicleInformation->mileage,
            'manufacturer' => $inspection->vehicleInformation->manufacturer->name,
            'modelType' => $inspection->vehicleInformation->modelType->name,
            'model_year' => $inspection->vehicleInformation->model_year,
            'color' => $inspection->vehicleInformation->color->name_ar,
            'originCountry' => $inspection->vehicleInformation->originCountry->name_ar,
            'branch' => $inspection->branch->name_ar,
            'customPort' => $inspection->customPort->name_ar,
            'created_at' => app(\App\Services\DateService::class)->gregorian($inspection->created_at),
            'custom_declaration_no' => $inspection->custom_declaration_no,
            'custom_declaration_date' => app(\App\Services\DateService::class)->hijri($inspection->custom_declaration_date),
            'request_no' => $inspection->request_no,
            'customer' => $inspection->customer->name,
            'photos' => $inspection->photos,
            'remarks' => $inspection->vehicleInformation->remarks ?? '—',
            'inspector_name' => $inspection->vehicleInformation->inspector->name ?? '',
            'manager_name' => $inspection->branch->manager->name ?? '',
            'emission_final_result' => $inspection->emissionInspection->result,
            'headlight_final_result' => $inspection->headLightInspection->result,
            'brake_final_result' => $inspection->brakeInspection->result,
            'suspension_final_result' => $inspection->suspensionInspection->result,
            'side_slip_final_result' => $inspection->sideSlipInspection->result,
            'visual_final_result' => $inspection->visualInspection->result,
            'emission_co' => $inspection->emissionInspection->co ?? '-',
            'emission_hc' => $inspection->emissionInspection->hc ?? '-',
            'emission_opacity' => $inspection->emissionInspection->opacity ?? '-',
            'headlight_left' => $inspection->headLightInspection->left,
            'headlight_right' => $inspection->headLightInspection->right,
            'side_slip_value' => $inspection->sideSlipInspection->value,
            'suspension_fr' => $inspection->suspensionInspection->front_right,
            'suspension_fl' => $inspection->suspensionInspection->front_left,
            'suspension_rr' => $inspection->suspensionInspection->rear_right,
            'suspension_rl' => $inspection->suspensionInspection->rear_left,
            'rear_brake' => $inspection->brakeInspection->rear,
            'front_brake' => $inspection->brakeInspection->front,
            'parking_brake' => $inspection->brakeInspection->parking,
            'final_result' => ($inspection->final_result?->value ?? $inspection->final_result) == 'Pass' ? 'مطابق' : 'غير مطابق',
            'inspection' => $inspection,
            'visual_inspection_groups' => $visualInspectionGroups,
            'left_categories' => $leftCategories,

        ];


        return $reportData;
    }
}
