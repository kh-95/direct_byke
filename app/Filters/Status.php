<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Status
{
    public function __construct(public Request $request){ }

    public function handle(Builder $query, Closure $next) : Builder
    {
        return $next($query)->when($this->request->has('is_active'), function ($query) {
            $query->where('is_active' , $this->request?->is_active);
        });
    }
}
