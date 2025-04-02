<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    protected $fillable = [
        'user_id',
        'level',
        'university',
        'course',
        'year',
        'award',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
