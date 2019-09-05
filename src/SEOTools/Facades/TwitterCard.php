<?php

namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * TwitterCard is a facade for the `TwitterCards` implementation access.
 *
 * @see \Artesaos\SEOTools\Contracts\TwitterCards
 *
 * @method static string generate(bool $minify = false)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards addValue(string $key, array|string $value)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards setType(string $type)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards setTitle(string $title)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards setSite(string $site)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards setDescription(string $description)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards setUrl(string $url)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards addImage(string|array $image)
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards setImages(array $images)
 */
class TwitterCard extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'seotools.twitter';
    }
}
