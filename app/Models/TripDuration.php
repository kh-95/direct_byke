<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripDuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'duration',
        'price',
    ];

    public function bike():BelongsTo
    {
        return $this->belongsTo(Bike::class);
    }
}
