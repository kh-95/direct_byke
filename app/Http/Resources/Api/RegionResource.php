<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $currentLang = $request->header('lang');
         $lang = $currentLang ?? config('app.default_locale');
        return [
            'id' => $this->id,
            'name' => $this->{'name_' . $lang},
            'lat' => $this->lat,
            'lon' => $this->lon,
            'cities' => CityResource::collection($this->cities),

        ];
    }
}
