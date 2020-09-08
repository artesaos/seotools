<?php

namespace Apility\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * JsonLd is a facade for the `JsonLd` implementation access.
 *
 * @see \Apility\SEOTools\Contracts\JsonLd
 * @method static string generate(bool $minify = false)
 * @method static bool isEmpty()
 * @method static \Apility\SEOTools\Contracts\JsonLd addValue(string $key, array|string $value)
 * @method static \Apility\SEOTools\Contracts\JsonLd setType(string $type)
 * @method static \Apility\SEOTools\Contracts\JsonLd setName(string $name)
 * @method static \Apility\SEOTools\Contracts\JsonLd setTitle(string $title)
 * @method static \Apility\SEOTools\Contracts\JsonLd setSite(string $site)
 * @method static \Apility\SEOTools\Contracts\JsonLd setDescription(string $description)
 * @method static \Apility\SEOTools\Contracts\JsonLd setUrl(string $url)
 * @method static \Apility\SEOTools\Contracts\JsonLd addImage(array|string $image)
 * @method static \Apility\SEOTools\Contracts\JsonLd setImages(array $images)
 */
class JsonLd extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'seotools.json-ld';
    }
}
