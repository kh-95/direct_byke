<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Otp extends Model
{
    use HasFactory;

    public function scopeValid(Builder $query, string $target, string $type): void
    {
        $query->where('expires_at', '>', now())->where('target', $target)->where('type',$type);
    }
    protected $fillable = [
        'target',
        'code',
        'type',
        'expires_at',
        'user_id',
        'user_type',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
    ];
    public function user()
    {
        return $this->morphTo();
    }
}
