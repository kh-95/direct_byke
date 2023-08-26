<?php

namespace App\Http\Resources\Api;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request)
    {
        $currentLang = $request->header('lang');
        $lang = $currentLang ?? config('app.default_locale');
        return [
            'trip_id'              => $this->id,
            'invoice_number'    =>date('Y').'0001',
            'qr_code'    =>asset('/storage/QR/'.$this->Bike?->QR_code),
           'invoice_date' => (string) $this->created_at?->format('Y-m-d H:i'),
            'bike_id'           =>$this->Bike->id,
            'bike_name' => $this->Bike->{'name_' . $lang},
            'bike_type_name' => $this->Bike?->BikeType?->{'name_' . $lang},
            'total_price_trip' =>$this->total_price_trip,
            'discount' =>$this?->discount,
            'total_after_discount'=>$this->total_after_discount,
            'tax' => GeneralSetting::select('tax')->first(),
            'total_after_tax'=>$this->total_after_tax,
        ] ;
    }
}
