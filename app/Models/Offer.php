<?php

namespace App\Models;

use App\Helpers\Traits\Casts\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory,
    UnicodeJsonColumn,
   HasTranslations
    ,TraitsGetTranslatedData;

    protected $translatable = [
        'name'
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'bike_id',
        'percentage',
        'start_at',
        'end_at',
        'is_active',
    ];



    public function Bikes(): HasMany
    {
        return $this->hasMany(Bike::class);
    }

    public function scopeFilter ($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $bike_id = $request->bike_id;


        if ($keyword) {
            $query->where('name_ar','like', '%'.$keyword.'%')
                ->orWhere('name_en','like', '%'.$keyword.'%');
        }
        if ($bike_id) {
            $offer_id = Bike::where('id', $bike_id)->first()->offer_id;
            $query->where('id', $offer_id);
        }
        if ($status || $status === '0') {
            $query->where('is_active', $status);
        }
        return $query;
    }



}
