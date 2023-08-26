<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;


class TermCondition extends Model
{
    use HasFactory,
    HasTranslations
    ,TraitsGetTranslatedData;

    protected $guarded=[];
    
    public $table = 'term_conditions';

    public $fillable = [
        'content_ar',
        'content_en'
    ];

    protected $translatable = [
        'content'
    ];}
