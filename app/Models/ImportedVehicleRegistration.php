<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportedVehicleRegistration extends Model
{
    protected $fillable = [
        'inspection_id',
        'request_no',
        'request_date',
        'custom_declaration_no',
        'custom_declaration_date',
        'custom_port_id',
        'payment_type',
    ];

    protected function casts(): array
    {
        return [
            'request_date' => 'date',
            'custom_declaration_date' => 'date',
        ];
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }
    public function customPort(): BelongsTo

    {

        return $this->belongsTo(CustomPort::class);
    }
}
