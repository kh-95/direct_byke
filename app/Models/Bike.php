<?php

namespace App\Models;


use App\Helpers\Traits\Attributes\ImageAttribute;
use App\Helpers\Traits\Casts\UnicodeJsonColumn;
use App\Helpers\Traits\GetTranslatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Bike extends Model implements HasMedia
{
    use HasFactory, UnicodeJsonColumn, HasTranslations, InteractsWithMedia, ImageAttribute, GetTranslatedData;

    private const COLLECTION_NAME = 'image';

    public static $modelFiles = [
        'avatar' => self::_FILE_PATH
    ];

    protected $translatable = [
        'name'
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'bike_type_id',
        'is_active',
        'QR_code',
        'lat',
        'long'
    ];


    public function scopeDurationPrice($query)
    {

        return $query->wherehas('durations' ,function ($q){
           $q->where();
        });

    }

    public function BikeType(): BelongsTo
    {
        return $this->belongsTo(BikeType::class);
    }

    public function ReservationPrice(): BelongsTo
    {

        return $this->belongsTo(ReservationPrice::class);
    }

    public function image()
    {
        return $this->morphOne(File::class, 'imageable')->latest('id');
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function tripDurations(): HasMany
    {
        return $this->hasMany(TripDuration::class);
    }

    public function getAvatarPathAttribute()
    {
        return "storage/$this->table/" . self::_PROFILE . '/';
    }

    public function City(): BelongsTo
    {

        return $this->belongsTo(City::class);
    }

    public function Region(): BelongsTo
    {

        return $this->belongsTo(Region::class);
    }

    public function District(): BelongsTo
    {

        return $this->belongsTo(District::class);
    }


    public function durations()
    {
        return $this->hasMany(BikeDuration::class);
    }


    public function getProfileImageAttribute()
    {
        $avatar = isset($this->image) ? URL(asset($this->image)) : URL(asset('img/logo.png'));
        return asset($avatar);
    }

    public function scopeFilter($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $bike_type_id = $request->bike_type_id;

        if ($bike_type_id) {
            $query->where('bike_type_id', $bike_type_id);
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

    public function getImageUrlAttribute()
    {
        $avatar = isset($this->image?->file) ? URL(asset($this->image?->file)) : URL(asset('img/Direct_bike_logo.png'));
        return ($avatar);
    }

    const _PROFILE = 'avatar';
    const _FILES = false;
    const _FILE_PATH = "storage/bikes/" . self::_PROFILE . '/';


}
