<?php

namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

class JsonLd extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools.json-ld';
    }
}
