<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;


    public function BikeType(): BelongsTo
    {
        return $this->belongsTo(BikeType::class);
    }

    public function Bike(): BelongsTo
    {
        return $this->belongsTo(Bike::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function PaymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    
}
