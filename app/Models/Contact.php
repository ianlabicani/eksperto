<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'type',
        'value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
