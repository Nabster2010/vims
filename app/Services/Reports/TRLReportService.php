<?php

namespace App\Services\Reports;

use App\Models\Inspection;
use App\Services\DateService;

class TRLReportService
{
    public function build(Inspection $inspection): array
    {
        $inspection->loadMissing([
            'branch',
            'customer',
            'inspectionType',
            'vehicleInformation',
            'visualInspection.visualItemResults',
            'brakeInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'emissionInspection',
            'photos',
        ]);
        $visualInspection = $inspection->visualInspection->visualItemResults;
        $visualInspectionGroups = $visualInspection->load('visualItem')->groupBy(fn ($result) => $result->visualItem->category);
        $trlBasicItems = $inspection->visualInspection
            ->visualItemResults
            ->load('visualItem')
            ->where('visualItem.category', 'TRL-BASIC');

        $reportData = [
            'report_title' => 'تقرير فحص مقطورة  ',
            'report_no' => $inspection->reportNo,
            'inspection_type_code' => $inspection->inspectionType->code,
            'inspection_type_name' => $inspection->inspectionType->name,
            'report_date_gregorian' => app(DateService::class)->gregorian($inspection->created_at),
            'report_date_hijri' => app(DateService::class)->hijri($inspection->created_at),
            'branch_code' => $inspection->branch->code,
            'branch_name' => $inspection->branch->name,
            'branch_name_ar' => $inspection->branch->name_ar,
            'vin' => $inspection->vin,
            'number_of_seats' => $inspection->vehicleInformation->number_of_seats,
            'mileage' => $inspection->vehicleInformation->mileage,
            'manufacturer' => $inspection->vehicleInformation->manufacturer->name,
            'modelType' => $inspection->vehicleInformation->modelType->name,
            'model_division' => $inspection->vehicleInformation->model_division,
            'model_year' => $inspection->vehicleInformation->model_year,
            'manufacturing_year' => $inspection->vehicleInformation->manufacturing_year,
            'color' => $inspection->vehicleInformation->color->name_ar,
            'customer' => $inspection->customer->name,
            'owner_id' => $inspection->owner_id,
            'request_date' => app(DateService::class)->gregorian($inspection->request_date),
            // to be added to database
            'request_origin' => $inspection->request_origin ?? '---',
            'category' => $inspection->vehicleInformation->category->name ?? '--',
            // to be added to database
            'is_authorized_modification_center' => $inspection->is_authorized_modification_center,
            'modification_description' => $inspection->modification_description ?? '--',
            'modification_center_name' => $inspection->modification_center ?? '--',
            // to be added to database
            'modification_center_report_number' => $inspection->modification_center_report_no ?? '--',
            'originCountry' => $inspection->vehicleInformation->originCountry->name_ar,
            'branch' => $inspection->branch->name_ar,
            'created_at' => app(DateService::class)->gregorian($inspection->created_at),
            'request_no' => $inspection->request_no,
            'total_weight' => $inspection->vehicleInformation->gross_weight,
            'width' => $inspection->vehicleInformation->width ?? '--',
            'length' => $inspection->vehicleInformation->length ?? '--',
            'height' => $inspection->vehicleInformation->height ?? '--',
            'gross_weight' => $inspection->vehicleInformation->gross_weight ?? '--',
            'number_of_axles' => $inspection->vehicleInformation->number_of_axles,
            'front_axle_weight' => $inspection->vehicleInformation->front_axle_weight ?? '--',
            'rear_axle_weight' => $inspection->vehicleInformation->rear_axle_weight ?? '--',
            'other_axle_weight' => $inspection->vehicleInformation->other_axle_weight ?? '--',
            'photos' => $inspection->photos,
            'remarks' => $inspection->vehicleInformation->remarks ?? '—',
            'inspector_name' => $inspection->vehicleInformation->inspector->name ?? '',
            'manager_name' => $inspection->branch->manager->name ?? '',
            'visual_final_result' => $inspection->visualInspection->result,
            'final_result' => ($inspection->final_result?->value ?? $inspection->final_result) == 'Pass' ? 'مطابق' : 'غير مطابق',
            'inspection' => $inspection,
            'trl_basic_items' => $trlBasicItems,
            'visual_inspection_groups' => $visualInspectionGroups,

        ];

        return $reportData;
    }
}
