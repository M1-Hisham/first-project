<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
    /** @use HasFactory<\Database\Factories\JobVacancyFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'job_vacancies';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'location',
        'type',
        'salary',
        'requiredSkills',
        'viewCount',
        'categoryId',
        'companyId',
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

    protected function category()
    {
        return $this->belongsTo(JobCategories::class, 'categoryId', 'id');
    }

    protected function company()
    {
        return $this->belongsTo(Companies::class, 'companyId', 'id');
    }
}
