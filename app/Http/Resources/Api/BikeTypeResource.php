<?php

namespace App\Http\Resources\Api;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BikeTypeResource extends JsonResource
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
            'id' => (int)$this->id,
            'name' => $this->{'name_' . $lang},
            'bike_type_image' => asset($this->image?->file),
        ];
    }
}
