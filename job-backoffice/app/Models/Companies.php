<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    /** @use HasFactory<\Database\Factories\CompaniesFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'companies';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'address',
        'industry',
        'website',
        'owenerId',
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

    // Define relationship with User model (owner of the company)
    // one to many inverse relationship
    public function owner()
    {
        return $this->belongsTo(User::class, 'owenerId', 'id');
    }

    // Define relationship with JobVacancy model
    // has many relationship
    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class, 'companyId', 'id');
    }
}
