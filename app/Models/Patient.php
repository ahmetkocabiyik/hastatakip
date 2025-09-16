<?php

namespace App\Models;

use App\Enums\PatientForm;
use App\Enums\PatientGender;
use App\Enums\PatientSource;
use App\Enums\PatientStatus;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $casts = [
        "source" => PatientSource::class,
        "gender" => PatientGender::class,
        "notes" => "array",
    ];




    public function sgk(): BelongsTo
    {
        return $this->belongsTo(Sgk::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class)->withPivot("date","hospital_id","note","special_material","has_laser");
    }

    public function diagnoses(): BelongsToMany
    {
        return $this->belongsToMany(Diagnosis::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }











}
