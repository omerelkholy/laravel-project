<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'benefits' => $this->benefits,
            'salary_range' => $this->salary_range,
            'location' => $this->location,
            'work_type' => $this->work_type,
            'application_deadline' => $this->application_deadline,
            'company_logo' => $this->company_logo,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}