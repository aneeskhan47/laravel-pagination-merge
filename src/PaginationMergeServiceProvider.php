<?php

namespace Aneeskhan47\PaginationMerge;

use Illuminate\Support\ServiceProvider;

class PaginationMergeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('laravel-pagination-merge', function () {
            return new PaginationMerge;
        });
    }
}
