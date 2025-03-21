<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'category',
        'budget_amount',
        'alert_rate'
    ];
}
