<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentLang = $request->header('lang');
        $lang = $currentLang ?? config('app.default_locale');
        return [
            'id' => $this->id,
            'created_at' => (string) $this->created_at?->format('Y-m-d H:i'),
            'bike_type_name' => $this->BikeType?->{'name_' . $lang},
            'bike_name' => $this->Bike?->{'name_' . $lang},
            'bike_image' => asset($this->Bike->image->file),
            
        ];
    }
}
