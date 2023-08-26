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
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements HasMedia
{

    use HasApiTokens,
        HasFactory,
        Notifiable,
        InteractsWithMedia,
        ImageAttribute,
        HasRoles
       ;
       protected $primaryKey = 'id';

    private const COLLECTION_NAME = 'image';
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
        'phone_verified_at',
        'email_verified_at',
        'is_active',
    ];  

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
    

    public function image()
{
    return $this->morphOne(File::class, 'imageable')->latest('id');
}
   
    public function deviceTokens():MorphMany
    {
        return $this->morphMany(DeviceToken::class, 'tokenable');
    }


    public function contacts():HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function contactReplies():HasMany
    {
        return $this->hasMany(ContactReply::class);
    }
  
    
}
