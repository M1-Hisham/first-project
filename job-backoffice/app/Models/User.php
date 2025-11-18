<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Companies;
use App\Models\Resume;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids /*UUID*/ , SoftDeletes /*SoftDeletes deleted_at column*/ ;

    protected $table = 'users';

    protected $keyType = 'string'; // for Ulid/Uuid
    public $incrementing = false; // for Ulid/Uuid

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $detes = [
        'deleted_at',
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
            'deleted_at' => 'datetime',
        ];
    }

    // Define relationship with Companies model
    // has many relationship 
    public function companies()
    {
        return $this->hasOne(Companies::class, 'owenerId', 'id');
    }

    public function resumes()
    {
        return $this->hasMany(Resumes::class, 'userId', 'id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplications::class, 'userId', 'id');
    }
}
