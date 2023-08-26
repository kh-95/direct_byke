<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'name' => $this->{'name_' . $lang},
            'bike_id' => $this->bike_id,
            'bike_name' => $this->bike?->{'name_' . $lang},
            'percentage' => $this->percentage,
            'bike_type_name' => $this->bike?->BikeType?->{'name_' . $lang},
            'bike_image' => asset($this->bike?->image->file),
        ];
    }
}
