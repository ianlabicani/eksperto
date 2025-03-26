<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ContractNegotiation extends Model
{
    use HasUuids;

    protected $fillable = [
        'job_contract_id',
        'expert_id',
        'negotiation_message',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',

    ];

    public function jobContract()
    {
        return $this->belongsTo(JobContract::class, 'job_contract_id');
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }
}
