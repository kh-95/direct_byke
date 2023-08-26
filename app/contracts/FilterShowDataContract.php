<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterShowDataContract
{
    public function handle(Builder $builder, array $pipelines, ?int $perPage): array;
}
