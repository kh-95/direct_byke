<?php

namespace App\Helpers\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;


trait SearchScope
{
    /**
     * Scope a query to only include popular users.
     */
    public function scopeSearch(Builder $query, ?string $keyword): void
    {
        $query->where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%");
    }
}
