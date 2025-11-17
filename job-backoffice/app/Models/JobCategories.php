<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategories extends Model
{
    /** @use HasFactory<\Database\Factories\JobCategoriesFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'job_categories';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
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

    protected function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class, 'categoryId', 'id');
    }
}
