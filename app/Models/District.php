<?php

namespace App\Models;

use App\Helpers\Traits\Casts\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;


class District extends Model
{
    use HasFactory,
        UnicodeJsonColumn,
        HasTranslations
        , TraitsGetTranslatedData;

    protected $guarded = [];

    protected $translatable = [
        'name'
    ];

    public static $rules = [
        'lat' => 'required|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
        'lon' => 'required|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function bikes(): HasMany

    {
        return $this->hasMany(Bike::class);

    }

    public function scopeFilter($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $city_id = $request->city_id;
        $region_id = $request->region_id;

        if ($region_id) {
            $cities = City::where('region_id', $region_id)->get();
            $cities_ids = $cities->pluck('id')->toArray();
            $query->whereIn('city_id', $cities_ids);
        }
        if ($city_id) {
            $query->where('city_id', $city_id);
        }

        if ($status || $status === '0') {
            $query->where('is_active', $status);
        }
        if ($keyword) {
            $query->where('name_ar', 'like', '%' . $keyword . '%')
                ->orWhere('name_en', 'like', '%' . $keyword . '%');
        }
        return $query;
    }


}
