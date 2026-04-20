<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PatientResult extends Model
{
    protected $casts = [
        'date' => 'date',
    ];

    protected static function booted(): void
    {
        static::deleting(function (PatientResult $result) {
            if ($result->file) {
                Storage::disk('public')->delete($result->file);
            }
        });
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
