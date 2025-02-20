<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->mentor->user->first_name,
            'last_name' => $this->mentor->user->last_name,
            'mentor_id' => $this->mentor->id,
            'chat_id' => $this->id,
            'message_text' => $this->latestMessage?->message_text,
            'message_media' => $this->latestMessage?->message_media ? asset("storage/{$this->latestMessage->message_media}") : null,
            'created_at' => $this->latestMessage?->created_at,
        ];
    }

    private function structureDate($date)
    {
        if (!$date) {
            return null;
        }

        if ($date instanceof Carbon) {
            return $date->diffForHumans();
        }

        // Otherwise, parse the date as a Carbon instance
        return Carbon::parse($date)->diffForHumans();
    }
}
