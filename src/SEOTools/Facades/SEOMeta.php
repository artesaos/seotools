<?php

namespace Artesaos\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * SEOMeta is a facade for the `MetaTags` implementation access.
 *
 * @see \Artesaos\SEOTools\Contracts\MetaTags
 *
 * @method static string generate(bool $minify = false)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setTitle(string $title, bool $appendDefault = true)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setTitleDefault(string $default)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setTitleSeparator(string $separator)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setDescription(string $description)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setKeywords(array|string $keywords)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags addKeyword(string $keyword)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags removeMeta(string $key)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags addMeta(array|string $meta, string|null $value = null, string $name = 'name')
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setCanonical(string $url)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setPrev(string $url)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags setNext(string $url)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags addAlternateLanguage(string $lang, string $url)
 * @method static \Artesaos\SEOTools\Contracts\MetaTags addAlternateLanguages(array $languages)
 * @method static string getTitle()
 * @method static string getTitleSession()
 * @method static string getTitleSeparator()
 * @method static array getMetatags()
 * @method static array getKeywords()
 * @method static string|null getDescription()
 * @method static string getCanonical()
 * @method static string getPrev()
 * @method static string getNext()
 * @method static string getAlternateLanguages()
 * @method static string getDefaultTitle()
 * @method static void reset()
 */
class SEOMeta extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'seotools.metatags';
    }
}
