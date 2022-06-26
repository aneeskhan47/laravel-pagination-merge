<?php

namespace Aneeskhan47\PaginationMerge\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Aneeskhan47\PaginationMerge\PaginationMerge
 */
class PaginationMerge extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-pagination-merge';
    }
}
