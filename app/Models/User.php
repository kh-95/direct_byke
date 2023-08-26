<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Traits\Attributes\ImageAttribute;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable implements HasMedia
{

    use HasApiTokens,
        HasFactory,
        Notifiable,
        InteractsWithMedia,
        ImageAttribute
       ;
    private const COLLECTION_NAME = 'image';
    
    public static $modelFiles = [
        'avatar' => self::_FILE_PATH
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'birthday',
        'second_phone',
        'phone_verified_at',
        'email_verified_at',
        'full_address',
        'is_active',
        'latitude',
        'longitude'
    ];
    const _PROFILE = 'avatar';
    const _PASSWORDS = true;
    const _FILES = false;
    const _FILE_PATH = "storage/clients/" . self::_PROFILE . '/';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];
    

   
    public function deviceTokens():MorphMany
    {
        return $this->morphMany(DeviceToken::class, 'tokenable');
    }


    public function otps(): MorphMany
    {
        return $this->morphMany(Otp::class, 'user');
    }


    public function getAvatarPathAttribute()
    {
        return "storage/$this->table/" . self::_PROFILE . '/';
    }

    public function getProfileImageAttribute()
    {
        $avatar = isset($this->image) ? URL(asset($this->image)) : URL(asset('img/logo.png')) ;
        return asset($avatar);
    }







    public function contacts():HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function contactReplies():HasMany
    {
        return $this->hasMany(ContactReply::class);
    }




    public function scopeUserData($query, $request)
    {
        return $query->where('phone', $request->phone)
                     ->where('user_type','client')
                    
        
           ;
    }
   


    
}
