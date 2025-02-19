<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mentor_id' => $this->mentor->id,
            'image' => $this->profile_picture ? asset("storage/profile_pictures/{$this->profile_picture}") : null,
            'company' => $this->mentor?->company,
            'expertise' => $this->mentor?->expertise,
        ];
    }
}
