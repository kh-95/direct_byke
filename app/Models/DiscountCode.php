<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_code',
        'rate_discount_code',
        'start_at',
        'end_at',
        'number_usage',
        'is_active',
        
    ];

    public function scopeFilter ($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        if ($status || $status === '0') {
            $query->where('is_active', $status);
        }
        if ($keyword) {
            $query->where('discount_code','like', '%'.$keyword.'%');
        }
        return $query;
    }




}
