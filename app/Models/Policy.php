<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;
use Spatie\Translatable\HasTranslations;

class Policy extends Model
{
    use HasFactory,
    HasTranslations
    ,TraitsGetTranslatedData;

    public $table = 'policies';
    protected $guarded=[];
    
    protected $translatable = [
        'content'
    ];



}
