<?php

namespace Apility\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * SEOMeta is a facade for the `MetaTags` implementation access.
 *
 * @see \Apility\SEOTools\Contracts\MetaTags
 *
 * @method static string generate(bool $minify = false)
 * @method static \Apility\SEOTools\Contracts\MetaTags setTitle(string $title, bool $appendDefault = true)
 * @method static \Apility\SEOTools\Contracts\MetaTags setTitleDefault(string $default)
 * @method static \Apility\SEOTools\Contracts\MetaTags setTitleSeparator(string $separator)
 * @method static \Apility\SEOTools\Contracts\MetaTags setDescription(string $description)
 * @method static \Apility\SEOTools\Contracts\MetaTags setKeywords(array|string $keywords)
 * @method static \Apility\SEOTools\Contracts\MetaTags addKeyword(string $keyword)
 * @method static \Apility\SEOTools\Contracts\MetaTags removeMeta(string $key)
 * @method static \Apility\SEOTools\Contracts\MetaTags addMeta(array|string $meta, string|null $value = null, string $name = 'name')
 * @method static \Apility\SEOTools\Contracts\MetaTags setCanonical(string $url)
 * @method static \Apility\SEOTools\Contracts\MetaTags setPrev(string $url)
 * @method static \Apility\SEOTools\Contracts\MetaTags setNext(string $url)
 * @method static \Apility\SEOTools\Contracts\MetaTags addAlternateLanguage(string $lang, string $url)
 * @method static \Apility\SEOTools\Contracts\MetaTags addAlternateLanguages(array $languages)
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
