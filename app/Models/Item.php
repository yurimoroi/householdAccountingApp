<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // timestamp
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type',
        'create_dt',
        'category',
        'amount',
        "content"
    ];
}
