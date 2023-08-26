<?php

namespace App\Helpers\Traits\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ImageAttribute
{
    /**
     * Images Morph Relation
     *
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(config('media-library.media_model'), 'model')
            ->where('collection_name', self::COLLECTION_NAME);
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => (string) $this->images?->first()?->getFullUrl()
        );
    }
}
