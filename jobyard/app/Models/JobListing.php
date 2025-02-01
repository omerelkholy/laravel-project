<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'requirements', 
        'benefits', 'salary_range', 'location', 'work_type', 
        'application_deadline', 'company_logo', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the approved method
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}