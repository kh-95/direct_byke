<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Contracts\FilterShowDataContract;
use App\Actions\FilterAndPaginationAction;
use App\Providers\TelescopeServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(FilterShowDataContract::class, FilterAndPaginationAction::class);
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Validator::extend('update_unique', function ($attribute, $value, $parameters) {
            list($table, $field, $field2, $field2Value) = $parameters;
            return \DB::table($table)->where($field, $value)
                    ->where($field2, '!=', $field2Value)
                    ->where('deleted_at' , null)
                    ->count() == 0;
        });
        Validator::extend('create_unique', function ($attribute, $value, $parameters) {
            list($table, $field) = $parameters;
            return \DB::table($table)
                    ->where($attribute, $value)
                    ->where(function($q) use($attribute){
                        $q->whereNotNull($attribute)->whereNot($attribute, '');
                    })
                    ->where('deleted_at' , null)
                    ->count() == 0;
        });
        Validator::extend('phone', function ($attribute, $value) {
            return preg_match('/[(]?05[)]?[-]?([0-9]{8})/', $value);

        });
    }
}
