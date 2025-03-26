<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JobContract extends Model
{
    use HasUuids;

    protected $fillable = [
        'job_application_id',
        'client_id',
        'expert_id',
        'status',
        'start_date',
        'end_date',
        'contract_terms',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',

    ];

    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function contractNegotiation()
    {
        return $this->hasOne(ContractNegotiation::class);
    }
}
