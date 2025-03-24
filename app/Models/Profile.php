<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'middle_name',
        'last_name',
        'suffix',
        'date_of_birth',
        'contact',
        'age',
        'house_number',
        'street',
        'barangay',
        'municipality',
        'province'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
