<?php

namespace App\Services\Reports;

use App\Enums\PhotoType;
use App\Models\Inspection;
use App\Services\DateService;

class SaberReportService
{
    public function build(Inspection $inspection): array
    {
        $inspection = $inspection->loadMissing([
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
            'photos' => fn ($query) => $query->whereIn('photo_type', [
                PhotoType::FRONT,
                PhotoType::REAR,
                PhotoType::LEFT,
                PhotoType::RIGHT,
                PhotoType::VIN,
                PhotoType::ODOMETER,
            ]),
        ]);
        $visualInspection = $inspection->visualInspection->visualItemResults;
        $visualInspectionGroups = $visualInspection->load('visualItem')->groupBy(fn ($result) => $result->visualItem->category);
        $leftCategories = ['internal', 'interior', 'safety', 'modern_systems', 'fuel_economy', 'other'];

        $reportData = [
            'report_title' => 'تقرير فحص مركبة - سابر',
            'report_no' => $inspection->reportNo,
            'inspection_type_code' => $inspection->inspectionType->code,
            'inspection_type_name' => $inspection->inspectionType->name,
            'report_date_gregorian' => app(DateService::class)->gregorian($inspection->created_at),
            'report_date_hijri' => app(DateService::class)->hijri($inspection->created_at),
            'branch_code' => $inspection->branch->code,
            'branch_name' => $inspection->branch->name,
            'branch_name_ar' => $inspection->branch->name_ar,
            'vin' => $inspection->vin,
            'fuel_type' => $inspection->vehicleInformation->fuel_type,
            'number_of_seats' => $inspection->vehicleInformation->number_of_seats,
            'mileage' => $inspection->vehicleInformation->mileage,
            'manufacturer' => $inspection->vehicleInformation->manufacturer->name,
            'modelType' => $inspection->vehicleInformation->modelType->name,
            'model_year' => $inspection->vehicleInformation->model_year,
            'manufacturing_year' => $inspection->vehicleInformation->manufacturing_year,
            'color' => $inspection->vehicleInformation->color->name_ar,
            'vehicle_condition' => $inspection->vehicleInformation->vehicle_condition,
            // vehicle details
            'gearbox' => $inspection->vehicleInformation->gearbox_type,
            'model_division' => $inspection->vehicleInformation->model_division ?? '',
            'category' => $inspection->vehicleInformation->category->name,
            'originCountry' => $inspection->vehicleInformation->originCountry->name_ar,
            'productionCountry' => $inspection->vehicleInformation->productionCountry->name_ar,
            'shipmentCountry' => $inspection->vehicleInformation->shipmentCountry->name_ar,
            'drive_line' => $inspection->vehicleInformation->drive_line,
            'air_intake' => $inspection->vehicleInformation->air_intake,
            'engine_no' => $inspection->vehicleInformation->engine_no,
            'engine_displacement' => $inspection->vehicleInformation->engine_displacement,
            'engine_power' => $inspection->vehicleInformation->engine_power,
            'engine_power_rpm' => $inspection->vehicleInformation->engine_power_rpm,
            'number_of_cylinders' => $inspection->vehicleInformation->number_of_cylinders,
            'maximum_speed' => $inspection->vehicleInformation->maximum_speed,
            'electric_motor_power' => $inspection->vehicleInformation->electric_motor_power,
            'battery_type' => $inspection->vehicleInformation->battery_type,
            'battery_capacity' => $inspection->vehicleInformation->battery_capacity,
            'battery_voltage' => $inspection->vehicleInformation->battery_voltage,
            'battery_charge_time' => $inspection->vehicleInformation->battery_charge_time,
            'electric_consumption' => $inspection->vehicleInformation->electric_consumption,
            'width' => $inspection->vehicleInformation->width,
            'height' => $inspection->vehicleInformation->height,
            'length' => $inspection->vehicleInformation->length,
            'wheelbase' => $inspection->vehicleInformation->wheelbase,
            'gross_weight' => $inspection->vehicleInformation->gross_weight,
            'curb_weight' => $inspection->vehicleInformation->curb_weight,
            'load_weight' => $inspection->vehicleInformation->load_weight,
            'number_of_axles' => $inspection->vehicleInformation->number_of_axles,
            'front_axle_weight' => $inspection->vehicleInformation->front_axle_weight,
            'rear_axle_weight' => $inspection->vehicleInformation->rear_axle_weight,
            'front_track_width' => $inspection->vehicleInformation->front_track_width,
            'rear_track_width' => $inspection->vehicleInformation->rear_track_width,
            'number_of_doors' => $inspection->vehicleInformation->number_of_doors,
            'service_brake' => $inspection->vehicleInformation->service_brake,
            'emergency_brake' => $inspection->vehicleInformation->emergency_brake,
            'fuel_economy' => $inspection->vehicleInformation->fuel_economy,
            'equivalent_fuel_economy' => $inspection->vehicleInformation->equivalent_fuel_economy,
            'energy_efficiency_compliance' => $inspection->vehicleInformation->energy_efficiency_compliance,
            'fuel_economy_compliance' => $inspection->vehicleInformation->fuel_economy_compliance,
            'vehicle_age_compliance' => $inspection->vehicleInformation->vehicle_age_compliance,
            'is_vehicle_rare' => $inspection->vehicleInformation->is_vehicle_rare,

            // ------

            'branch' => $inspection->branch->name_ar,
            'customPort' => $inspection->customPort->name_ar ?? '----',
            'created_at' => app(DateService::class)->gregorian($inspection->created_at),
            'custom_declaration_no' => $inspection->custom_declaration_no ?? '---',
            'custom_declaration_date' => app(DateService::class)->hijri($inspection->custom_declaration_date) ?? '---',
            'request_no' => $inspection->request_no,
            'customer' => $inspection->customer->name,
            'photos' => $inspection->photos,
            'remarks' => $inspection->vehicleInformation->remarks ?? '—',
            'inspector_name' => $inspection->vehicleInformation->inspector->name ?? '',
            'manager_name' => $inspection->branch->manager->name ?? '',
            'emission_final_result' => $inspection->emissionInspection?->result ?? 'N/A',
            'headlight_final_result' => $inspection->headLightInspection?->result ?? '-',
            'brake_final_result' => $inspection->brakeInspection?->result ?? '-',
            'suspension_final_result' => $inspection->suspensionInspection?->result ?? '-',
            'side_slip_final_result' => $inspection->sideSlipInspection?->result ?? '-',
            'visual_final_result' => $inspection->visualInspection?->result ?? '-',
            'emission_co' => $inspection->emissionInspection?->co ?? '-',
            'emission_hc' => $inspection->emissionInspection?->hc ?? '-',
            'emission_opacity' => $inspection->emissionInspection?->opacity ?? '-',
            'headlight_left' => $inspection->headLightInspection?->left ?? '-',
            'headlight_right' => $inspection->headLightInspection?->right ?? '-',
            'side_slip_value' => $inspection->sideSlipInspection?->value ?? '-',
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
            'vehicleInformation' => $inspection->vehicleInformation,

        ];

        return $reportData;
    }
}
