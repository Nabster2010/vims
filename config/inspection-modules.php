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
    ],
    //saber gasoline & diesel & mild hybrid
    'SBG' => [
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::HeadLightInspection,
        InspectionModule::SideSlipInspection,
        InspectionModule::SuspensionInspection,
        InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],

    //saber electric EV
    'SBE' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::EmissionInspection,
        InspectionModule::HeadLightInspection,
        InspectionModule::SideSlipInspection,
        InspectionModule::SuspensionInspection,
        InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],

    //saber hybrid
    'SBH' => [
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::HeadLightInspection,
        InspectionModule::SideSlipInspection,
        InspectionModule::SuspensionInspection,
        InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],


    'MDL' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::SideSlipInspection,
        // InspectionModule::SuspensionInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],

    'MDH' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::SideSlipInspection,
        // InspectionModule::SuspensionInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],

    'MTC' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],
    'TRL' => [
        InspectionModule::VehicleInformation,
        // InspectionModule::HeadLightInspection,
        // InspectionModule::BrakeInspection,
        InspectionModule::VisualInspection,
    ],

];
