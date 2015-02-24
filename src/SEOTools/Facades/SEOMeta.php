<?php namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

class SEOMeta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools.metatags';
    }
}