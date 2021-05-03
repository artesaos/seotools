<?php

namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * JsonLd is a facade for the `JsonLd` implementation access.
 *
 * @see \Artesaos\SEOTools\Contracts\JsonLdMulti
 * @method static string generate(bool $minify = false)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti newJsonLd()
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti isEmpty()
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti select(int $index)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti addValue(string $key, array|string $value)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti addValues(array $values)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti setType(string $type)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti setTitle(string $title)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti setSite(string $site)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti setDescription(string $description)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti setUrl(string $url)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti addImage(array|string $image)
 * @method static \Artesaos\SEOTools\Contracts\JsonLdMulti setImages(array $images)
 */
class JsonLdMulti extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'seotools.json-ld-multi';
    }
}
