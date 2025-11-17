<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resumes extends Model
{
    /** @use HasFactory<\Database\Factories\ResumesFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'resumes';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'fileName',
        'fileURL',
        'contactDetails',
        'skills',
        'summary',
        'experience',
        'education',
        'userId',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
            'deleted_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    protected function jobApplications()
    {
        return $this->hasMany(JobApplications::class, 'resumeId', 'id');
    }
}
