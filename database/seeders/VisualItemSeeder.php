<?php

namespace Database\Seeders;

use App\Models\VisualItem;
use Illuminate\Database\Seeder;

class VisualItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [

            [
                'sort_order' => 1,
                'code' => 'VehicleDimensions',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Vehicle Dimensions and Weight',
                'name_ar' => 'أبعاد وأوزان المركبة',
                'is_active' => true,
            ],

            [
                'sort_order' => 2,
                'code' => 'VehicleColor',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Vehicle Color',
                'name_ar' => 'لون المركبة',
                'is_active' => true,
            ],

            [
                'sort_order' => 3,
                'code' => 'VehicleIdentificationNumber',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Vehicle Identification Number',
                'name_ar' => 'الرقم المميز للمركبة',
                'is_active' => true,
            ],

            [
                'sort_order' => 4,
                'code' => 'VehicleDataPlate',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Vehicle Identification Plate',
                'name_ar' => 'معلومات لوحة بيانات المركبة',
                'is_active' => true,
            ],

            [
                'sort_order' => 5,
                'code' => 'BodyChassis',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Body / Chassis / Frame',
                'name_ar' => 'سلامة الهيكل الخارجي / الشاسيه / الجسور / القواطع',
                'is_active' => true,
            ],

            [
                'sort_order' => 6,
                'code' => 'ElectricalWiring',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Electrical Wiring',
                'name_ar' => 'مجموعة التوصيلات الكهربائية',
                'is_active' => true,
            ],

            [
                'sort_order' => 7,
                'code' => 'BrakeSystem',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake System',
                'name_ar' => 'مجموعة المكابح',
                'is_active' => true,
            ],

            [
                'sort_order' => 8,
                'code' => 'BrakeMasterCylinder',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Master Cylinder',
                'name_ar' => 'الأسطوانات الرئيسية لنظام المكابح',
                'is_active' => true,
            ],

            [
                'sort_order' => 9,
                'code' => 'BrakeFluidReservoir',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Fluid Reservoir',
                'name_ar' => 'خزان سائل المكابح',
                'is_active' => true,
            ],

            [
                'sort_order' => 10,
                'code' => 'BrakeHosesPipes',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Hoses and Pipes',
                'name_ar' => 'خراطيم / أنابيب / وصلات فرملة اليد',
                'is_active' => true,
            ],

            [
                'sort_order' => 11,
                'code' => 'BrakeBooster',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Booster',
                'name_ar' => 'دواسة المكابح',
                'is_active' => true,
            ],

            [
                'sort_order' => 12,
                'code' => 'AirTankBrakeComponents',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Air Tank and Brake Components',
                'name_ar' => 'خزان الهواء ومكونات نظام المكابح',
                'is_active' => true,
            ],

            [
                'sort_order' => 13,
                'code' => 'BrakeDiscsPads',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Discs and Pads',
                'name_ar' => 'أقراص المكابح واللبادات واللقم والفحمات',
                'is_active' => true,
            ],

            [
                'sort_order' => 14,
                'code' => 'BrakeEfficiency',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Efficiency',
                'name_ar' => 'الفحص الآلي لكفاءة المكابح',
                'is_active' => true,
            ],

            [
                'sort_order' => 15,
                'code' => 'StaticTest',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Static Test',
                'name_ar' => 'الفحص الاستاتيكي',
                'is_active' => true,
            ],

            [
                'sort_order' => 16,
                'code' => 'DynamicTest',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Dynamic Test',
                'name_ar' => 'الفحص الديناميكي',
                'is_active' => true,
            ],

            [
                'sort_order' => 17,
                'code' => 'Lights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Lights',
                'name_ar' => 'الأنوار',
                'is_active' => true,
            ],

            [
                'sort_order' => 18,
                'code' => 'MainHeadlights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Main Headlights',
                'name_ar' => 'الأنوار الأمامية الرئيسية',
                'is_active' => true,
            ],

            [
                'sort_order' => 19,
                'code' => 'ReverseLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Reverse Lights',
                'name_ar' => 'أنوار السير الخلفية',
                'is_active' => true,
            ],

            [
                'sort_order' => 20,
                'code' => 'RearLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Rear Lights',
                'name_ar' => 'أنوار الضباب الخلفية',
                'is_active' => true,
            ],

            [
                'sort_order' => 21,
                'code' => 'FrontLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Front Lights',
                'name_ar' => 'أنوار السير الأمامية',
                'is_active' => true,
            ],

            [
                'sort_order' => 22,
                'code' => 'TurnSignalLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Turn Signal Lights',
                'name_ar' => 'أنوار إشارات الدوران والانعطاف الأمامية والجانبية والخلفية',
                'is_active' => true,
            ],

            [
                'sort_order' => 23,
                'code' => 'HazardLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Hazard Lights',
                'name_ar' => 'أنوار التحذير',
                'is_active' => true,
            ],

            [
                'sort_order' => 24,
                'code' => 'RearReverseLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Rear Reverse Lights',
                'name_ar' => 'أنوار السير إلى الخلف',
                'is_active' => true,
            ],

            [
                'sort_order' => 25,
                'code' => 'LicensePlateLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'License Plate Lights',
                'name_ar' => 'أنوار لوحة الأرقام الخلفية',
                'is_active' => true,
            ],
            [
                'sort_order' => 26,
                'code' => 'BrakeLights',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Brake Lights',
                'name_ar' => 'أنوار التوقف (المكابح)',
            ],

            [
                'sort_order' => 27,
                'code' => 'VehicleGlass',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Vehicle Glass',
                'name_ar' => 'زجاج المركبة (الأمامي والخلفي والنوافذ)',
            ],

            [
                'sort_order' => 28,
                'code' => 'SteeringSystem',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Steering System',
                'name_ar' => 'مجموعة التوجيه',
            ],

            [
                'sort_order' => 29,
                'code' => 'SteeringWheel',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Steering Wheel',
                'name_ar' => 'عجلة القيادة',
            ],

            [
                'sort_order' => 30,
                'code' => 'BallJoints',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Ball Joints',
                'name_ar' => 'الوصلات الكروية',
            ],

            [
                'sort_order' => 31,
                'code' => 'SteeringLinkage',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Steering Linkage',
                'name_ar' => 'مجموعة أذرع التوجيه',
            ],

            [
                'sort_order' => 32,
                'code' => 'SteeringBox',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Steering Box',
                'name_ar' => 'علبة التوجيه',
            ],

            [
                'sort_order' => 33,
                'code' => 'HydraulicSteering',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Hydraulic Steering',
                'name_ar' => 'دائرة التوجيه الهيدروليكية',
            ],

            [
                'sort_order' => 34,
                'code' => 'BalanceRod',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Balance Rod',
                'name_ar' => 'عمود التوازن',
            ],

            [
                'sort_order' => 35,
                'code' => 'DriveShaft',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Drive Shaft',
                'name_ar' => 'أجزاء ناقل الحركة / عمود الكردان / عمود الدوران',
            ],

            [
                'sort_order' => 36,
                'code' => 'Suspension',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Suspension',
                'name_ar' => 'مجموعة التعليق',
            ],

            [
                'sort_order' => 37,
                'code' => 'SuspensionComponents',
                'category' => 'external',
                'category_ar' => 'الفحص الخارجي',
                'name' => 'Suspension Components',
                'name_ar' => 'نظام التعليق الأمامي والخلفي',
            ],

            [
                'sort_order' => 38,
                'code' => 'Springs',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Front & Rear Springs',
                'name_ar' => 'النوابض الأمامية والخلفية',
            ],

            [
                'sort_order' => 39,
                'code' => 'ShockAbsorbers',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Shock Absorbers',
                'name_ar' => 'ممتص الصدمات (المساعدات)',
            ],

            [
                'sort_order' => 40,
                'code' => 'ExhaustAssembly',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Exhaust System',
                'name_ar' => 'مجموعة العادم',
            ],

            [
                'sort_order' => 41,
                'code' => 'Muffler',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Silencer',
                'name_ar' => 'مخمد الأصوات / مواسير العادم',
            ],

            [
                'sort_order' => 42,
                'code' => 'WindshieldWipers',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Windshield Wipers',
                'name_ar' => 'مساحات وغسالات الزجاج الأمامي',
            ],

            [
                'sort_order' => 43,
                'code' => 'RearViewMirrors',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Rear Mirrors',
                'name_ar' => 'المرايا الجانبية الخارجية للرؤية الخلفية',
            ],

            [
                'sort_order' => 44,
                'code' => 'DoorsLocks',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Doors & Locks',
                'name_ar' => 'أقفال الأبواب ومفصلاتها وغطاء المحرك والصندوق الخلفي',
            ],

            [
                'sort_order' => 45,
                'code' => 'Tires',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Tires',
                'name_ar' => 'الإطارات',
            ],

            [
                'sort_order' => 46,
                'code' => 'Wheels',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Wheels',
                'name_ar' => 'العجلات',
            ],

            [
                'sort_order' => 47,
                'code' => 'Engine',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Engine',
                'name_ar' => 'المحرك',
            ],

            [
                'sort_order' => 48,
                'code' => 'NoiseEmission',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Noise Pollution',
                'name_ar' => 'التلوث الضوضائي',
            ],

            [
                'sort_order' => 49,
                'code' => 'FuelSystem',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Fuel System',
                'name_ar' => 'مجموعة الوقود',
            ],

            [
                'sort_order' => 50,
                'code' => 'ProtectionBars',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Protection Bars',
                'name_ar' => 'حواجز الحماية الأمامية والجانبية والخلفية للشاحنات',
            ],
            [
                'sort_order' => 51,
                'code' => 'VehicleStability',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Vehicle Stability',
                'name_ar' => 'التأكد من أن المركبة لا تميل ولا تنحرف',
            ],

            [
                'sort_order' => 52,
                'code' => 'SpareWheel',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Spare Wheel',
                'name_ar' => 'العجلة الاحتياطية',
            ],

            [
                'sort_order' => 53,
                'code' => 'GasCylinder',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Gas Cylinders',
                'name_ar' => 'أسطوانات الغاز',
            ],

            [
                'sort_order' => 54,
                'code' => 'PetrolEmission',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Petrol Emissions',
                'name_ar' => 'غازات العادم للمركبات البنزين',
            ],

            [
                'sort_order' => 55,
                'code' => 'DieselEmission',
                'category' => 'internal',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Diesel Emissions',
                'name_ar' => 'غازات العادم للمركبات الديزل',
            ],

            [
                'sort_order' => 56,
                'code' => 'Horn',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Horn',
                'name_ar' => 'أداة التنبيه الصوتي',
            ],

            [
                'sort_order' => 57,
                'code' => 'HandBrake',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Hand Brake',
                'name_ar' => 'فرملة اليد',
            ],

            [
                'sort_order' => 58,
                'code' => 'SeatBelts',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Seat Belts',
                'name_ar' => 'أحزمة الأمان',
            ],

            [
                'sort_order' => 59,
                'code' => 'Seats',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Seats',
                'name_ar' => 'المقاعد',
            ],

            [
                'sort_order' => 60,
                'code' => 'InteriorMirror',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Rear View Mirror',
                'name_ar' => 'المرآة الداخلية للرؤية الخلفية',
            ],

            [
                'sort_order' => 61,
                'code' => 'HeadRest',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Head Rest',
                'name_ar' => 'مساند الرأس',
            ],

            [
                'sort_order' => 62,
                'code' => 'SunVisor',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Sun Visor',
                'name_ar' => 'حاجبات الشمس',
            ],

            [
                'sort_order' => 63,
                'code' => 'Speedometer',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Speedometer',
                'name_ar' => 'عداد السرعة',
            ],

            [
                'sort_order' => 64,
                'code' => 'Odometer',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Odometer',
                'name_ar' => 'عداد المسافات',
            ],

            [
                'sort_order' => 65,
                'code' => 'SpeedWarning',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Speed Warning',
                'name_ar' => 'جهاز إنذار تجاوز السرعة',
            ],

            [
                'sort_order' => 66,
                'code' => 'DashboardIndicators',
                'category' => 'interior',
                'category_ar' => 'الفحص الداخلي',
                'name' => 'Dashboard Indicators',
                'name_ar' => 'مؤشرات لوحة القيادة',
            ],

            [
                'sort_order' => 67,
                'code' => 'SafetyRequirements',
                'category' => 'safety',
                'category_ar' => 'متطلبات السلامة',
                'name' => 'Safety Requirements',
                'name_ar' => 'متطلبات السلامة',
            ],

            [
                'sort_order' => 68,
                'code' => 'ModernSystems',
                'category' => 'modern_systems',
                'category_ar' => 'الأنظمة الحديثة',
                'name' => 'Modern Systems',
                'name_ar' => 'الأنظمة الحديثة',
            ],

            [
                'sort_order' => 69,
                'code' => 'FuelEconomyStandard',
                'category' => 'fuel_economy',
                'category_ar' => 'اقتصاد الوقود',
                'name' => 'Fuel Economy Standard',
                'name_ar' => 'معيار اقتصاد الوقود للمركبات ذات الخدمة الخفيفة',
            ],

            [
                'sort_order' => 70,
                'code' => 'NotArmored',
                'category' => 'other',
                'category_ar' => 'متطلبات أخرى',
                'name' => 'Vehicle is not Armored',
                'name_ar' => 'المركبة ليست مصفحة',
            ],

            [
                'sort_order' => 71,
                'code' => 'NotTaxi',
                'category' => 'other',
                'category_ar' => 'متطلبات أخرى',
                'name' => 'Vehicle is not Taxi',
                'name_ar' => 'المركبة ليست سيارة أجرة',
            ],

            [
                'sort_order' => 72,
                'code' => 'NotSalvage',
                'category' => 'other',
                'category_ar' => 'متطلبات أخرى',
                'name' => 'Vehicle is not Salvage',
                'name_ar' => 'المركبة ليست سالفج أو غرق',
            ],

            [
                'sort_order' => 73,
                'code' => 'NotPoliceVehicle',
                'category' => 'other',
                'category_ar' => 'متطلبات أخرى',
                'name' => 'Vehicle is not Police Vehicle',
                'name_ar' => 'المركبة ليست من سيارات الشرطة',
            ],

        ];

        foreach ($items as $item) {
            VisualItem::updateOrCreate(
                ['code' => $item['code']],
                $item
            );
        }
    }
}
