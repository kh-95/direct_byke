<?php

namespace App\Models;

use App\Helpers\Traits\Casts\UnicodeJsonColumn;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;


class Region extends Model
{
    use HasFactory,
    UnicodeJsonColumn,
   HasTranslations
    ,TraitsGetTranslatedData;
    protected $guarded=[];

    protected $translatable = [
        'name'
    ];

    public static $rules = [
        'lat' => 'required|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
        'lon' => 'required|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
    ];
    public function cities():HasMany
    {
        return $this->hasMany(City::class);
    }
    public function districts():HasMany
    {
        return $this->hasMany(District::class);
    }
    public function bikes():HasMany

    {
      return $this->hasMany(Bike::class);

    }
    public function scopeFilter ($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        if ($status || $status === '0') {
            $query->where('is_active', $status);
        }
        if ($keyword) {
            $query->where('name_ar','like', '%'.$keyword.'%')
                ->orWhere('name_en','like', '%'.$keyword.'%');
        }
        return $query;
    }

}
