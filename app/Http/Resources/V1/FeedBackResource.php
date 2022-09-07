<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class FeedBackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'feedback' => $this->feedback,
            'feedback_file' => $this->feedback_file,
            'type' => $this->type,
            'issue' => $this->issue,
            'created_at' => $date = Carbon::parse($this->created_at)->diffInHours(Carbon::now()),
        ];
    }
}
