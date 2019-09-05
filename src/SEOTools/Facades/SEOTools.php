<?php

namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * SEOTools is a facade for the `SEOTools` implementation access.
 *
 * @see \Artesaos\SEOTools\Contracts\SEOTools
 *
 * @method static string generate(bool $minify = false)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags metatags()
 * @method static \Artesaos\SEOTools\Contracts\OpenGraph opengraph()
 * @method static \Artesaos\SEOTools\Contracts\TwitterCards twitter()
 * @method static \Artesaos\SEOTools\Contracts\JsonLd jsonLd()
 * @method static \Artesaos\SEOTools\Contracts\SEOTools setTitle(string $title, bool $appendDefault = true)
 * @method static \Artesaos\SEOTools\Contracts\SEOTools setDescription(string $description)
 * @method static \Artesaos\SEOTools\Contracts\SEOTools setCanonical(string $url)
 * @method static \Artesaos\SEOTools\Contracts\SEOTools addImages(array $urls)
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
