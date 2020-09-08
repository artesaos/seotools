<?php

namespace Apility\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * JsonLd is a facade for the `JsonLd` implementation access.
 *
 * @see \Apility\SEOTools\Contracts\JsonLdMulti
 * @method static string generate(bool $minify = false)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti newJsonLd()
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti isEmpty()
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti select(int $index)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti addValue(string $key, array|string $value)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setType(string $type)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setName(string $name)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setTitle(string $title)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setSite(string $site)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setDescription(string $description)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setUrl(string $url)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti addImage(array|string $image)
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti setImages(array $images)
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
