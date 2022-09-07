<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CinemaVideoResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'poster' => $this->poster,
            'teaser' => $this->teaser,
            'director' => $this->director,
            'country' => $this->country,
            'genre' => $this->genre,
            'writers' => $this->writers,
            'actors' => $this->actors,
            'release' => $this->release,
            'price' => $this->price,
            'discountFromUser' => $this->discountFromUser,
            'discountFromProgram' => $this->discountFromProgram,
        ];
    }
}
