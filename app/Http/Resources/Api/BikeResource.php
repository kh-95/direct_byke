<?php

namespace App\Http\Resources\Api;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
        return [
            'id' => (int)$this->id,
            'bike_id' => $this->bike_id,
            'duration' => $this->duration

        
        ];
    }
}
