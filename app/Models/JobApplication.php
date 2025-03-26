<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JobApplication extends Model
{
    use HasUuids;

    protected $fillable = ['client_id', 'expert_id', 'job_listing_id', 'cover_letter', 'status'];

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }

    public function jobContract()
    {
        return $this->hasOne(JobContract::class);
    }
}
