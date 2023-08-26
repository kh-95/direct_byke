<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;


class AboutAPP extends Model
{
    use HasFactory,
    HasTranslations
    ,TraitsGetTranslatedData;

    public $table = 'about_apps';
    protected $guarded=[];
    
    protected $translatable = [
        'content'
    ];


}
