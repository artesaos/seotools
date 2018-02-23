<?php

namespace Tsawler\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

class SEOTools extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools';
    }
}
