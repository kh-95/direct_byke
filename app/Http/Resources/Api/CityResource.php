<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        $currentLang = session('lang') ?? $request->header('lang');
        $currentLang = $request->header('lang');
        $lang = $currentLang ?? config('app.default_locale');
        return [
            'id' => $this->id,
            'name' => $this->{'name_' . $lang},
            'lat' => $this->lat,
            'lon' => $this->lon,
            'region_id' => $this->region_id,
            'region' => $this->region?->{'name_' . $lang},
            'districts' => DistrictResource::collection($this->districts)

          
        ];
    }
}
