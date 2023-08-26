<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'region_id' => $this->region_id,
            'city' => optional($this->city)->name,
        ];
    }
}
