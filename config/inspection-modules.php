<?php

use App\Enums\InspectionModule;

return [

    'IMP' => [
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::HeadLightInspection,
        InspectionModule::SideSlipInspection,
        InspectionModule::SuspensionInspection,
        InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
        InspectionModule::Photos,
    ],

    'SBR' => [
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::HeadLightInspection,
        InspectionModule::SideSlipInspection,
        InspectionModule::SuspensionInspection,
        InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
        InspectionModule::Photos,
    ],



    'MDL' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::SideSlipInspection,
        // InspectionModule::SuspensionInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
        InspectionModule::Photos,
    ],

    'MDH' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::SideSlipInspection,
        // InspectionModule::SuspensionInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
        InspectionModule::Photos,
    ],

    'MTC' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
        InspectionModule::Photos,
    ],
    'TRL' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
        InspectionModule::Photos,
    ],

];
