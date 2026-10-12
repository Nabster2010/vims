<?php

namespace App\Enums;

enum BodyType: string
{
    case Sedan = 'Sedan';
    case Hatchback = 'Hatchback';
    case Suv = 'SUV';
    case Coupe = 'Coupe';
    case Convertible = 'Convertible';
    case Pickup = 'Pickup';
    case Van = 'Van';
    case Bus = 'Bus';
    case Truck = 'Truck';
    case Wagon = 'Wagon';
    case Motorcycle = 'Motorcycle';
}
