<?php

namespace App\Http\Resources\Api;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class FilterBikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $currentLang = $request->header('lang');
        $lang = $currentLang ?? config('app.default_locale');
        return [
            'id' => $this->id,
            'name' => $this->{'name_' . $lang},
            'bike_type_name' => $this->BikeType?->{'name_' . $lang},
            'bike_image' => asset($this->image?->file),
            'lat' => $this->lat,
            'lon' => $this->lon,
            'durations' => BikeDurationResource::collection($this->durations),
            'price_per_minute' => (float)DB::table('general_settings')->pluck('price_per_minute')->first(),
            'discount_offer' => $this->offer?->percentage,
        ];
    }
}
