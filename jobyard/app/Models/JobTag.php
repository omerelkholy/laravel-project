<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobTag extends Model
{
    /** @use HasFactory<\Database\Factories\JobTagFactory> */
    use HasFactory;



    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
