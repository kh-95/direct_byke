<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendNotification extends Model
{
    public $table = 'send_notification';

    public $guarded = ['id'];

    const _PROFILE = 'avatar';
    const _PASSWORDS = false;
    const _FILES = true;
    const _FILE_PATH = "storage/categories/" . self::_PROFILE . '/';

    public static $modelFiles = [
        'avatar' => self::_FILE_PATH
    ];

    public function getAvatarPathAttribute()
    {
        return "storage/$this->table/" . self::_PROFILE . '/';
    }

    public function getAvatarUrlAttribute()
    {
        /*
        $avatar = self::_PROFILE;
        return asset($this->avatar_path . $$avatar);
        */
        $avatar = $this->avatar;
        return asset($this->avatar_path . $avatar);
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function getSenderTypeAttribute()
    {
        switch ($this->sender) {
            case "clients":
                return __('العملاء');
                
            case "client":
                return trans('عملاء مخصصين');
          
            default:
                return "";
        }
    }

}
