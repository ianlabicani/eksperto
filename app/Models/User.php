<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

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

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function educationalBackgrounds()
    {
        return $this->hasMany(EducationalBackground::class);
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function expertises()
    {
        return $this->hasMany(Expertise::class);
    }

    public function isProfileComplete()
    {
        if (!$this->profile()->exists()) {
            return false;
        }

        if (!$this->contacts()->exists()) {
            return false;
        }

        if (!$this->address()->exists()) {
            return false;
        }

        return true;
    }

    public function getIncompleteProfileFields()
    {
        $incompleteFields = [];

        // Check personal information
        if (
            !$this->profile()->exists() ||
            !$this->profile->first_name ||
            !$this->profile->last_name ||
            !$this->profile->date_of_birth ||
            !$this->profile->sex
        ) {
            $incompleteFields[] = 'personal';
        }

        // Check contact information
        if (!$this->contacts()->exists()) {
            $incompleteFields[] = 'contact';
        }

        // Check address information
        if (
            !$this->address()->exists() ||
            !$this->address->house_number ||
            !$this->address->street ||
            !$this->address->barangay ||
            !$this->address->municipality ||
            !$this->address->province ||
            !$this->address->zip_code
        ) {
            $incompleteFields[] = 'address';
        }

        // For experts, check additional required fields
        if ($this->isExpert()) {
            // Check educational background
            if (!$this->educationalBackgrounds()->exists()) {
                $incompleteFields[] = 'education';
            }

            // Check work experience
            if (!$this->workExperiences()->exists()) {
                $incompleteFields[] = 'experience';
            }

            // Check expertise
            if (!$this->expertises()->exists()) {
                $incompleteFields[] = 'expertise';
            }
        }

        return $incompleteFields;
    }

}
