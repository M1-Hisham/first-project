<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class JobApplications extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationsFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'job_applications';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'status',
        'aiGeneratedScore',
        'aiGeneratedFeedback',
        'jobId',
        'resumeId',
        'userId',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'applied_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
            'deleted_at' => 'datetime:Y-m-d H:i:s',
            'applied_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    protected function resume()
    {
        return $this->belongsTo(Resumes::class, 'resumeId', 'id');
    }

    protected function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'jobId', 'id');
    }
}
