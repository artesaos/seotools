<?php

namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * JsonLd is a facade for the `JsonLd` implementation access.
 *
 * @see \Artesaos\SEOTools\Contracts\JsonLd
 * @method static string generate(bool $minify = false)
 * @method static bool isEmpty()
 * @method static \Artesaos\SEOTools\Contracts\JsonLd addValue(string $key, string|array $value)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd addValues(array $values)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd setType(string $type)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd setTitle(string $title)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd setSite(string $site)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd setDescription(string $description)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd setUrl(string|null|bool $url)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd addImage(string|array $image)
 * @method static \Artesaos\SEOTools\Contracts\JsonLd setImages(string|array $images)
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
