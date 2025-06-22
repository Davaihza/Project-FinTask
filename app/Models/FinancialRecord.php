<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialRecord extends Model
{
    protected $fillable = [
        'description',
        'amount',
        'type',
        'date',
        'image',
    ];
}
