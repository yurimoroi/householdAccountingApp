<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name'
    ];
}
