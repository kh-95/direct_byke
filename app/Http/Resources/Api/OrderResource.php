<?php

namespace App\Http\Resources\Api;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
        return [
            'id' =>$this->id,
            'price_min' => GeneralSetting::select('price_per_minute')->first(),
            'duration' => $this->duration,
            'price' =>(float) $this->price,
            'total_reservation'=> number_format($this->price * $this->duration,2,'.','') ,
            'tax' => GeneralSetting::select('tax')->first(),
            'total_after_tax'=> $this->total_reservation +$this->tax
        
        ];
    }
}
