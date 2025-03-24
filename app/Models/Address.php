<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'house_number',
        'street',
        'barangay',
        'municipality',
        'province',
        'zip_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
