<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
            'bike' => $this->bikes,
        ];
    }
}
