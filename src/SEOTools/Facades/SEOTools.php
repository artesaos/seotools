<?php

namespace Apility\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * SEOTools is a facade for the `SEOTools` implementation access.
 *
 * @see \Apility\SEOTools\Contracts\SEOTools
 *
 * @method static string generate(bool $minify = false)
 * @method static \Apility\SEOTools\Contracts\MetaTags metatags()
 * @method static \Apility\SEOTools\Contracts\OpenGraph opengraph()
 * @method static \Apility\SEOTools\Contracts\TwitterCards twitter()
 * @method static \Apility\SEOTools\Contracts\JsonLd jsonLd()
 * @method static \Apility\SEOTools\Contracts\JsonLdMulti jsonLdMulti()
 * @method static \Apility\SEOTools\Contracts\SEOTools setTitle(string $title, bool $appendDefault = true)
 * @method static \Apility\SEOTools\Contracts\SEOTools setDescription(string $description)
 * @method static \Apility\SEOTools\Contracts\SEOTools setCanonical(string $url)
 * @method static \Apility\SEOTools\Contracts\SEOTools addImages(array $urls)
 * @method static string getTitle(bool $session = false)
 */
class SEOTools extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'seotools';
    }
}
