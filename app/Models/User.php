<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'client_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'expert_id');
    }

    public function jobApplicants()
    {
        return $this->hasMany(JobApplication::class, 'client_id');
    }

    public function isClient()
    {
        return $this->roles()->where('name', 'client')->exists();
    }

    public function isExpert()
    {
        return $this->roles()->where('name', 'expert')->exists();
    }

    public function isPeso()
    {
        return $this->roles()->where('name', 'peso')->exists();
    }

    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


}
