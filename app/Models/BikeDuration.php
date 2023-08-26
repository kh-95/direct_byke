<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BikeDuration extends Model
{
    use HasFactory;


    protected $table = 'bike_duration';

    protected $guarded = [];
    protected $appends = ['price_of_duration'];

    public function Bike(): BelongsTo
    {
        return $this->belongsTo(Bike::class);
    }


    public function getPriceOfDurationAttribute()
    {
        $price_per_minute = GeneralSetting::pluck('price_per_minute')->first();
        $price = $price_per_minute * $this->duration;
        return $price;
    }


}
