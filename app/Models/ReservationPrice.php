<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationPrice extends Model
{
    use HasFactory;
    protected $guarded = ['created_at'];

    #region properties
    #endregion properties

    #region mutators
    #endregion mutators

    #region scopes
    #endregion scopes

    #region relationships
    #endregion relationships

    public function bikes(): HasMany
    {

        return $this->hasMany(Bike::class);
    }

    #region custom Methods
    #endregion custom Methods
}
