<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'description',
        'category',
        'salary',
        'location',
        'job_type',
        'requirements',
        'status',
        'deadline'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function jobApplications($status = null)
    {
        $query = $this->hasMany(JobApplication::class);

        if ($status) {
            $query->where('status', $status);
        }

        return $query;
    }

}
