<?php

namespace App\Services\Inspection;

use App\Enums\InspectionModule;
use App\Enums\InspectionModuleStatus;
use App\Models\Inspection;

class InspectionModuleStatusService
{
    public static function getStatuses(Inspection $inspection): array
    {
        return [

            InspectionModule::VehicleInformation->value => $inspection->vehicleInformation()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

            InspectionModule::VisualInspection->value => $inspection->visualInspection()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

            InspectionModule::EmissionInspection->value => $inspection->emissionInspection()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

            InspectionModule::BrakeInspection->value => $inspection->brakeInspection()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

            InspectionModule::SuspensionInspection->value => $inspection->suspensionInspection()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

            InspectionModule::SideSlipInspection->value => $inspection->sideSlipInspection()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

            InspectionModule::HeadLightInspection->value => $inspection->headlightInspection()->exists()
                ? InspectionModuleStatus::Completed
                : InspectionModuleStatus::NotStarted,

        ];
    }
}
