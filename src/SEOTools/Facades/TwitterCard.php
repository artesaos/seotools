<?php

namespace Apility\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * TwitterCard is a facade for the `TwitterCards` implementation access.
 *
 * @see \Apility\SEOTools\Contracts\TwitterCards
 *
 * @method static string generate(bool $minify = false)
 * @method static \Apility\SEOTools\Contracts\TwitterCards addValue(string $key, array|string $value)
 * @method static \Apility\SEOTools\Contracts\TwitterCards setType(string $type)
 * @method static \Apility\SEOTools\Contracts\TwitterCards setTitle(string $title)
 * @method static \Apility\SEOTools\Contracts\TwitterCards setSite(string $site)
 * @method static \Apility\SEOTools\Contracts\TwitterCards setDescription(string $description)
 * @method static \Apility\SEOTools\Contracts\TwitterCards setUrl(string $url)
 * @method static \Apility\SEOTools\Contracts\TwitterCards addImage(string|array $image)
 * @method static \Apility\SEOTools\Contracts\TwitterCards setImages(array $images)
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
