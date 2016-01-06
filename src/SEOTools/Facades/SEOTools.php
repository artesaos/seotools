<?php namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

class SEOTools extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools';
    }
}