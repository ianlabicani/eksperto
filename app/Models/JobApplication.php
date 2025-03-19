<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = ['expert_id', 'job_listing_id', 'cover_letter', 'status'];

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
