<?php

namespace App\Http\Resources\Api;

use App\Models\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripDetailsResource extends JsonResource
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

        if($this->status=='finished'){

            $end_at = Carbon::parse($this->end_at)->format('Y-m-d');
            $rate = $this->rate;
            $comment=$this->comment;
        }
        return [
            'id' => $this->id,
            'start_at' =>  $this->start_at,
            'end_at' =>  $end_at,
            'bike_name' => $this->Bike?->{'name_' . $lang},
            'bike_id' =>$this->Bike?->id,
            'bike_type_name' => $this->BikeType?->{'name_' . $lang},
            'bike_image' =>$this->Bike?->avatar_path,
            'price_bike_per_minute' => GeneralSetting::select('price_per_minute')->first(),
            'total_price_trip' =>$this->total_price_trip,
            'discount' =>$this?->discount,
            'total_after_discount'=>$this->total_after_discount,
            'tax' => GeneralSetting::select('tax')->first(),
            'total_after_tax'=>$this->total_after_tax,
            'payment_method' =>$this->PaymentMethod?->type,
            'rate' =>$rate ,
            'comment' =>$comment


            



            
        ];
    }
}
