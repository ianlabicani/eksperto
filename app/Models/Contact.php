<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Contact extends Model
{

    use HasUuids;

    protected $fillable = [
        'type',
        'value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
