<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentForm extends Model
{
    protected $fillable = [
        'name',
        'document',
    ];
}
