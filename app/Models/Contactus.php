<?php

namespace App\Models;

use App\Models\MessageType\MessageType;
use App\Traits\Loggable;
use App\Traits\Uuid;
use GeniusTS\HijriDate\Hijri;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contactus extends Model
{
    use HasFactory;

    #region properties
    protected $guarded = ['created_at', 'updated_at'];
    


    #endregion properties
    #region relationships

    

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }


  


    

 
}
