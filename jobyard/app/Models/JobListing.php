<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class JobListing extends Model
{
    /** @use HasFactory<\Database\Factories\JobListingFactory> */
    use HasFactory, Searchable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }


    public function jobTag(): HasMany
    {
        return $this->hasMany(JobTag::class);
    }


    public function toSearchableArray(): array
    {
        return [
            'title'=>$this->title,
            'benefits'=>$this->benefits,
            'requirements'=>$this->requirements,
            'salary_range'=>$this->salary_range,
            'location'=>$this->location,
            'work_type'=>$this->work_type
        ];
    }
}
