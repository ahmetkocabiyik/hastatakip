<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Diagnosis extends Model
{
    //
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class);
    }
}
