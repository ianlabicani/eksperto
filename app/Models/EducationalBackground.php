<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{

    use HasUuids;

    protected $fillable = [
        'user_id',
        'level',
        'university',
        'course',
        'year',
        'award',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
