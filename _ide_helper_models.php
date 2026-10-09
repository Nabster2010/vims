<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $name_ar
 * @property string $code
 * @property string $address
 * @property int|null $manager_id
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $logo_path
 * @property string|null $stamp_path
 * @property int $last_inspection_sequence
 * @property bool $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Inspection> $inspections
 * @property-read int|null $inspections_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereLastInspectionSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereStampPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branch whereUuid($value)
 */
	class Branch extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $name_ar
 * @property string $iso2
 * @property string $iso3
 * @property int $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereIso2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereIso3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $name_ar
 * @property string $code
 * @property int $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPort whereUpdatedAt($value)
 */
	class CustomPort extends \Eloquent {}
}

namespace App\Models{
/**
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property int $id
 * @property \App\Enums\CustomerType $customer_type
 * @property \App\Enums\IdentityType $identity_type
 * @property string $name
 * @property string $identity_number
 * @property string|null $vat_number
 * @property string $mobile
 * @property string|null $email
 * @property string|null $address
 * @property string|null $notes
 * @property bool $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Inspection> $inspections
 * @property-read int|null $inspections_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer search(?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereIdentityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $inspection_no
 * @property int $branch_id
 * @property int $inspection_type_id
 * @property int $customer_id
 * @property int $sales_representative_id
 * @property string $vin
 * @property string|null $request_no
 * @property \Carbon\CarbonImmutable|null $request_date
 * @property string|null $custom_declaration_no
 * @property \Carbon\CarbonImmutable|null $custom_declaration_date
 * @property int|null $custom_port_id
 * @property string|null $payment_type
 * @property numeric|null $payment_amount
 * @property int|null $import_country_id
 * @property string|null $plate_no
 * @property string|null $modification_center
 * @property string|null $current_type
 * @property string|null $target_type
 * @property string|null $owner_id
 * @property \App\Enums\InspectionStatus $status
 * @property \App\Enums\InspectionResult|null $final_result
 * @property int $created_by
 * @property int|null $inspector_id
 * @property int|null $approved_by
 * @property \Carbon\CarbonImmutable $registered_at
 * @property \Carbon\CarbonImmutable|null $inspection_started_at
 * @property \Carbon\CarbonImmutable|null $inspection_completed_at
 * @property \Carbon\CarbonImmutable|null $approved_at
 * @property int $reinspection_count
 * @property bool $is_locked
 * @property string|null $remarks
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\User|null $approvedBy
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\User $createdBy
 * @property-read \App\Models\CustomPort|null $customPort
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\Country|null $importCountry
 * @property-read \App\Models\InspectionType $inspectionType
 * @property-read \App\Models\User|null $inspector
 * @property-read \App\Models\SalesRepresentative $salesRepresentative
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCurrentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCustomDeclarationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCustomDeclarationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCustomPortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereFinalResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereImportCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereInspectionCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereInspectionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereInspectionStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereInspectionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereInspectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereModificationCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection wherePlateNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereReinspectionCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereRequestDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereRequestNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereSalesRepresentativeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereTargetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inspection whereVin($value)
 */
	class Inspection extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $name_ar
 * @property string $prefix
 * @property int $is_active
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InspectionType whereUpdatedAt($value)
 */
	class InspectionType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $company_name
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $notes
 * @property bool $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Inspection> $inspections
 * @property-read int|null $inspections_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesRepresentative whereUpdatedAt($value)
 */
	class SalesRepresentative extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \App\Models\Branch|null $branch
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

