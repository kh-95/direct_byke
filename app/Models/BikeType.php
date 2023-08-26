<?php

namespace App\Models;


use App\Helpers\Traits\Attributes\ImageAttribute;
use App\Helpers\Traits\Casts\UnicodeJsonColumn;
use App\Helpers\Traits\GetTranslatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class BikeType extends Model implements HasMedia
{
    use HasFactory, UnicodeJsonColumn, HasTranslations, InteractsWithMedia, ImageAttribute, GetTranslatedData;

    private const COLLECTION_NAME = 'image';

    protected $guarded = [];

    protected $translatable = [
        'name'
    ];

    public static $modelFiles = [
        'avatar' => self::_FILE_PATH
    ];

    public function bikes(): HasMany
    {
        return $this->hasMany(Bike::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function scopeFilter($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        if ($keyword) {
            $query->where('name_ar', 'like', '%' . $keyword . '%')
                ->orWhere('name_en', 'like', '%' . $keyword . '%');
        }
        if ($status || $status === '0') {
            $query->where('is_active', $status);
        }
        return $query;
    }

    public function image()
    {
        return $this->morphOne(File::class, 'imageable')->latest('id');
    }

    public function getAvatarPathAttribute()
    {
        return "storage/$this->table/" . self::_PROFILE . '/';
    }

    public function getImageUrlAttribute()
    {
        $avatar = isset($this->image?->file) ? URL(asset($this->image?->file)) : URL(asset('img/Direct_bike_logo.png'));
        return ($avatar);
    }

    const _PROFILE = 'avatar';
    const _FILES = false;
    const _FILE_PATH = "storage/bikeTypes/" . self::_PROFILE . '/';

}
