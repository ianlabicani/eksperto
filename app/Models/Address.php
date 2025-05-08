<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasUuids;

    protected $fillable = [
        'house_number',
        'street',
        'barangay',
        'municipality',
        'province',
        'region',
        'zip_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
