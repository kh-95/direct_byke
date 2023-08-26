<?php

namespace App\Actions;

use App\Contracts\FilterShowDataContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class FilterAndPaginationAction implements FilterShowDataContract
{
    public function __construct(
        private  Pipeline $pipeline
    ) {
    }
    public function handle(Builder $builder, array $pipelines, ?int $perPage = 10): array
    {

        if((bool)request('is_paginate',true)==true) {
            $resultSet = $this->pipeline->send($builder)
                ->through($pipelines)->thenReturn()->paginate(
                    $perPage
                );
            return [
                'items' => $resultSet,
                'links' => [
                    'first' => $resultSet->url(1),
                    'last' => $resultSet->url($resultSet->lastPage()),
                    'prev' => $resultSet->previousPageUrl(),
                    'next' => $resultSet->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $resultSet->currentPage(),
                    'from' => $resultSet->firstItem(),
                    'last_page' => $resultSet->lastPage(),
                    'path' => $resultSet->path(),
                    'per_page' => $resultSet->perPage(),
                    'to' => $resultSet->lastItem(),
                    'total' => $resultSet->total(),
                ]

            ];
        }else{
            $resultSet = $this->pipeline->send($builder)
                ->through($pipelines)->thenReturn()->get();
            return [
                'items' => $resultSet,
                'links' => [],
                'meta' => [],
            ];
        }
    }
}
