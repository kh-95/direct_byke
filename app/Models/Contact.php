<?php

namespace App\Models;

use App\Models\MessageType\MessageType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Traits\GetTranslatedData as TraitsGetTranslatedData;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory,HasTranslations
    ,TraitsGetTranslatedData;

    #region properties
    protected $guarded = ['created_at', 'updated_at'];
    const CONTACTS = ['fullname', 'email',  'phone', 'created_at'];
    const PENDING = 'pending';
    const REPLIED = 'replied';
    const MESSAGE_STATUS = [self::PENDING,self::REPLIED];

    const ORDER = 'ORDER';
    const SUGGESTION = 'SUGGESTION';
    const INQUIRY = 'INQUIRY';
    const COMPLAIN = 'COMPLAIN';
    const OTHER = 'OTHER';


    const MESSAGE_TYPE = [self::ORDER, self::SUGGESTION, self::INQUIRY,self::COMPLAIN,self::OTHER];
    
    protected $translatable = [

    ];
    #endregion properties

    #region mutators
    public function getReadAtAttribute($date)
    {
        return date('Y-m-d h:i A', strtotime($date));
    }
   
    #region relationships
    public function reply(): HasOne
    {
        return $this->hasOne(ContactReply::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter ($query, $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;

        $query->when($status, function ($q) use ($status) {
            $q->where('message_status', $status);
        })
        ->when($keyword, function ($q) use ($keyword) {
            $q->where('fullname', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%');
        });
        
        return $query;
    }
 
}
