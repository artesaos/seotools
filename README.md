<p align="center">
    <a href="https://github.com/artesaos" target="_blank">
        <img src="https://avatars3.githubusercontent.com/u/11164074" height="100px">
    </a>
    <h1 align="center">SEOTools - SEO Tools for Laravel and Lumen</h1>
    <br>
</p>

SEOTools is a package for [Laravel 5.8+](https://laravel.com/) and [Lumen](https://lumen.laravel.com/) that provides helpers for some common SEO techniques.

> Current Build Status

[![Build Status](https://travis-ci.org/artesaos/seotools.svg)](https://travis-ci.org/artesaos/seotools)
[![Code Climate](https://codeclimate.com/github/artesaos/seotools/badges/gpa.svg)](https://codeclimate.com/github/artesaos/seotools)

> Statistics

[![Latest Stable Version](https://poser.pugx.org/artesaos/seotools/v/stable)](https://packagist.org/packages/artesaos/seotools) [![Total Downloads](https://poser.pugx.org/artesaos/seotools/downloads)](https://packagist.org/packages/artesaos/seotools) [![Latest Unstable Version](https://poser.pugx.org/artesaos/seotools/v/unstable)](https://packagist.org/packages/artesaos/seotools) [![License](https://poser.pugx.org/artesaos/seotools/license)](https://packagist.org/packages/artesaos/seotools)

For license information check the [LICENSE](LICENSE.md)-file.

Features
--------

- Friendly simple interface
- Easy of set titles and meta tags
- Easy of set metas for [Twitter Cards](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/abouts-cards) and [Open Graph](https://ogp.me/)
- Easy of set for [JSON Linked Data](https://json-ld.org/)

Installation
------------

### 1 - Dependency

The first step is using composer to install the package and automatically update your `composer.json` file, you can do this by running:

```shell
composer require artesaos/seotools
```

> **Note**: If you are using Laravel 5.5, the steps 2 and 3, for providers and aliases, are unnecessaries. SEOTools supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

### 2 - Provider

You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
<?php

return [
    // ...
    'providers' => [
        Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class,
        // ...
    ],
    // ...
];
```

#### Lumen

Go to `/bootstrap/app.php` file and add this line:

```php
<?php
// ...

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// ...

$app->register(Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);

// ...

return $app;
```

### 3 - Facades

> Note: facades are not supported in Lumen.

You may get access to the SEO tool services using following facades:

 - `Artesaos\SEOTools\Facades\SEOMeta`
 - `Artesaos\SEOTools\Facades\OpenGraph`
 - `Artesaos\SEOTools\Facades\TwitterCard`
 - `Artesaos\SEOTools\Facades\JsonLd`
 - `Artesaos\SEOTools\Facades\SEOTools`

You can setup a short-version aliases for these facades in your `config/app.php` file. For example:

```php
<?php

return [
    // ...
    'aliases' => [
        'SEOMeta'   => Artesaos\SEOTools\Facades\SEOMeta::class,
        'OpenGraph' => Artesaos\SEOTools\Facades\OpenGraph::class,
        'Twitter'   => Artesaos\SEOTools\Facades\TwitterCard::class,
        'JsonLd'   => Artesaos\SEOTools\Facades\JsonLd::class,
        // or
        'SEO' => Artesaos\SEOTools\Facades\SEOTools::class,
        // ...
    ],
    // ...
];
```

### 4 Configuration

#### Publish config

In your terminal type

```shell
php artisan vendor:publish
```

or

```shell
php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"
```

> Lumen does not support this command, for it you should copy the file `src/resources/config/seotools.php` to `config/seotools.php` of your project

In `seotools.php` configuration file you can determine the properties of the default values and some behaviors.

#### seotools.php

- meta
 - **defaults** - What values are displayed if not specified any value for the page display. If the value is `false`, nothing is displayed.
 - **webmaster** - Are the settings of tags values for major webmaster tools. If you are `null` nothing is displayed.
- opengraph
 - **defaults** - Are the properties that will always be displayed and when no other value is set instead. **You can add additional tags** that are not included in the original configuration file.
- twitter
 - **defaults** - Are the properties that will always be displayed and when no other value is set instead. **You can add additional tags** that are not included in the original configuration file.
- json-ld
 - **defaults** - Are the properties that will always be displayed and when no other value is set instead. **You can add additional tags** that are not included in the original configuration file.

Usage
-----

### Lumen Usage

> Note: facades are not supported in Lumen.

```php
<?php

$seotools = app('seotools');
$metatags = app('seotools.metatags');
$twitter = app('seotools.twitter');
$opengraph = app('seotools.opengraph');
$jsonld = app('seotools.json-ld');

// The behavior is the same as the facade

echo app('seotools')->generate();
```

### Meta tags Generator

With **SEOMeta** you can create meta tags to the `head`

### Opengraph tags Generator

With **OpenGraph** you can create OpenGraph tags to the `head`

### Twitter for Twitter Cards tags Generator

With **Twitter** you can create OpenGraph tags to the `head`

#### In your controller

```php
<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR
use Artesaos\SEOTools\Facades\SEOTools;

class CommomController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Home');
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setCanonical('https://codecasts.com.br/lesson');

        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Homepage');
        TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle('Homepage');
        JsonLd::setDescription('This is my page description');
        JsonLd::addImage('https://codecasts.com.br/img/logo.jpg');

        // OR

        SEOTools::setTitle('Home');
        SEOTools::setDescription('This is my page description');
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $posts = Post::all();

        return view('myindex', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->resume);
        SEOMeta::addMeta('article:published_time', $post->published_date->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $post->category, 'property');
        SEOMeta::addKeyword(['key1', 'key2', 'key3']);

        OpenGraph::setDescription($post->resume);
        OpenGraph::setTitle($post->title);
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage($post->cover->url);
        OpenGraph::addImage($post->images->list('url'));
        OpenGraph::addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);
        OpenGraph::addImage('http://image.url.com/cover.jpg', ['height' => 300, 'width' => 300]);
        
        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->resume);
        JsonLd::setType('Article');
        JsonLd::addImage($post->images->list('url'));


        // Namespace URI: http://ogp.me/ns/article#
        // article
        OpenGraph::setTitle('Article')
            ->setDescription('Some Article')
            ->setType('article')
            ->setArticle([
                'published_time' => 'datetime',
                'modified_time' => 'datetime',
                'expiration_time' => 'datetime',
                'author' => 'profile / array',
                'section' => 'string',
                'tag' => 'string / array'
            ]);

        // Namespace URI: http://ogp.me/ns/book#
        // book
        OpenGraph::setTitle('Book')
            ->setDescription('Some Book')
            ->setType('book')
            ->setBook([
                'author' => 'profile / array',
                'isbn' => 'string',
                'release_date' => 'datetime',
                'tag' => 'string / array'
            ]);

        // Namespace URI: http://ogp.me/ns/profile#
        // profile
        OpenGraph::setTitle('Profile')
             ->setDescription('Some Person')
            ->setType('profile')
            ->setProfile([
                'first_name' => 'string',
                'last_name' => 'string',
                'username' => 'string',
                'gender' => 'enum(male, female)'
            ]);

        // Namespace URI: http://ogp.me/ns/music#
        // music.song
        OpenGraph::setType('music.song')
            ->setMusicSong([
                'duration' => 'integer',
                'album' => 'array',
                'album:disc' => 'integer',
                'album:track' => 'integer',
                'musician' => 'array'
            ]);

        // music.album
        OpenGraph::setType('music.album')
            ->setMusicAlbum([
                'song' => 'music.song',
                'song:disc' => 'integer',
                'song:track' => 'integer',
                'musician' => 'profile',
                'release_date' => 'datetime'
            ]);

         //music.playlist
        OpenGraph::setType('music.playlist')
            ->setMusicPlaylist([
                'song' => 'music.song',
                'song:disc' => 'integer',
                'song:track' => 'integer',
                'creator' => 'profile'
            ]);

        // music.radio_station
        OpenGraph::setType('music.radio_station')
            ->setMusicRadioStation([
                'creator' => 'profile'
            ]);

        // Namespace URI: http://ogp.me/ns/video#
        // video.movie
        OpenGraph::setType('video.movie')
            ->setVideoMovie([
                'actor' => 'profile / array',
                'actor:role' => 'string',
                'director' => 'profile /array',
                'writer' => 'profile / array',
                'duration' => 'integer',
                'release_date' => 'datetime',
                'tag' => 'string / array'
            ]);

        // video.episode
        OpenGraph::setType('video.episode')
            ->setVideoEpisode([
                'actor' => 'profile / array',
                'actor:role' => 'string',
                'director' => 'profile /array',
                'writer' => 'profile / array',
                'duration' => 'integer',
                'release_date' => 'datetime',
                'tag' => 'string / array',
                'series' => 'video.tv_show'
            ]);

        // video.tv_show
        OpenGraph::setType('video.tv_show')
            ->setVideoTVShow([
                'actor' => 'profile / array',
                'actor:role' => 'string',
                'director' => 'profile /array',
                'writer' => 'profile / array',
                'duration' => 'integer',
                'release_date' => 'datetime',
                'tag' => 'string / array'
            ]);

        // video.other
        OpenGraph::setType('video.other')
            ->setVideoOther([
                'actor' => 'profile / array',
                'actor:role' => 'string',
                'director' => 'profile /array',
                'writer' => 'profile / array',
                'duration' => 'integer',
                'release_date' => 'datetime',
                'tag' => 'string / array'
            ]);

        // og:video
        OpenGraph::addVideo('http://example.com/movie.swf', [
                'secure_url' => 'https://example.com/movie.swf',
                'type' => 'application/x-shockwave-flash',
                'width' => 400,
                'height' => 300
            ]);

        // og:audio
        OpenGraph::addAudio('http://example.com/sound.mp3', [
                'secure_url' => 'https://secure.example.com/sound.mp3',
                'type' => 'audio/mpeg'
            ]);

        // og:place
        OpenGraph::setTitle('Place')
             ->setDescription('Some Place')
            ->setType('place')
            ->setPlace([
                'location:latitude' => 'float',
                'location:longitude' => 'float',
            ]);

        return view('myshow', compact('post'));
    }
}
```

#### SEOTrait

```php
<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class CommomController extends Controller
{
    use SEOToolsTrait;

    public function index()
    {
        $this->seo()->setTitle('Home');
        $this->seo()->setDescription('This is my page description');
        $this->seo()->opengraph()->setUrl('http://current.url.com');
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->twitter()->setSite('@LuizVinicius73');
        $this->seo()->jsonLd()->setType('Article');

        $posts = Post::all();

        return view('myindex', compact('posts'));
    }
}
```

### In Your View

> **Pro Tip**: Pass the parameter `true` to get minified code and reduce filesize.

```html
<html>
<head>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <!-- OR -->
    {!! SEO::generate() !!}

    <!-- MINIFIED -->
    {!! SEO::generate(true) !!}

    <!-- LUMEN -->
    {!! app('seotools')->generate() !!}
</head>
<body>

</body>
</html>
```

```html
<html>
<head>
    <title>Title - Over 9000 Thousand!</title>
    <meta name='description' itemprop='description' content='description...' />
    <meta name='keywords' content='key1, key2, key3' />
    <meta property='article:published_time' content='2015-01-31T20:30:11-02:00' />
    <meta property='article:section' content='news' />

    <meta property="og:description"content="description..." />
    <meta property="og:title"content="Title" />
    <meta property="og:url"content="http://current.url.com" />
    <meta property="og:type"content="article" />
    <meta property="og:locale"content="pt-br" />
    <meta property="og:locale:alternate"content="pt-pt" />
    <meta property="og:locale:alternate"content="en-us" />
    <meta property="og:site_name"content="name" />
    <meta property="og:image"content="http://image.url.com/cover.jpg" />
    <meta property="og:image"content="http://image.url.com/img1.jpg" />
    <meta property="og:image"content="http://image.url.com/img2.jpg" />
    <meta property="og:image"content="http://image.url.com/img3.jpg" />
    <meta property="og:image:url"content="http://image.url.com/cover.jpg" />
    <meta property="og:image:size"content="300" />

    <meta name="twitter:card"content="summary" />
    <meta name="twitter:title"content="Title" />
    <meta name="twitter:site"content="@LuizVinicius73" />
    
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"Article","name":"Title - Over 9000 Thousand!"}</script>
</head>
<body>

</body>
</html>
```

#### API (SEOMeta)

```php
<?php

use Artesaos\SEOTools\Facades\SEOMeta;

SEOMeta::addKeyword($keyword);
SEOMeta::addMeta($meta, $value = null, $name = 'name');
SEOMeta::addAlternateLanguage($lang, $url);
SEOMeta::addAlternateLanguages(array $languages);
SEOMeta::setTitleSeparator($separator);
SEOMeta::setTitle($title);
SEOMeta::setTitleDefault($default);
SEOMeta::setDescription($description);
SEOMeta::setKeywords($keywords);
SEOMeta::setRobots($robots);
SEOMeta::setCanonical($url);
SEOMeta::setPrev($url);
SEOMeta::setNext($url);
SEOMeta::removeMeta($key);

// You can chain methods
SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setKeywords($keywords)
            ->addKeyword($keyword)
            ->addMeta($meta, $value);

// Retrieving data
SEOMeta::getTitle();
SEOMeta::getTitleSession();
SEOMeta::getTitleSeparator();
SEOMeta::getKeywords();
SEOMeta::getDescription();
SEOMeta::getCanonical($url);
SEOMeta::getPrev($url);
SEOMeta::getNext($url);
SEOMeta::getRobots();
SEOMeta::reset();

SEOMeta::generate();
```

#### API (OpenGraph)

```php
<?php

use Artesaos\SEOTools\Facades\OpenGraph;

OpenGraph::addProperty($key, $value); // value can be string or array
OpenGraph::addImage($url); // add image url
OpenGraph::addImages($url); // add an array of url images
OpenGraph::setTitle($title); // define title
OpenGraph::setDescription($description);  // define description
OpenGraph::setUrl($url); // define url
OpenGraph::setSiteName($name); //define site_name

// You can chain methods
OpenGraph::addProperty($key, $value)
            ->addImage($url)
            ->addImages($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setSiteName($name);

// Generate html tags
OpenGraph::generate();
```

### API (TwitterCard)

```php
<?php

use Artesaos\SEOTools\Facades\TwitterCard;

TwitterCard::addValue($key, $value); // value can be string or array
TwitterCard::setType($type); // type of twitter card tag
TwitterCard::setTitle($type); // title of twitter card tag
TwitterCard::setSite($type); // site of twitter card tag
TwitterCard::setDescription($type); // description of twitter card tag
TwitterCard::setUrl($type); // url of twitter card tag
TwitterCard::setImage($url); // add image url

// You can chain methods
TwitterCard::addValue($key, $value)
            ->setType($type)
            ->setImage($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setSite($name);

// Generate html tags
TwitterCard::generate();
```

### API (JsonLd)

```php
<?php

use Artesaos\SEOTools\Facades\JsonLd;

JsonLd::addValue($key, $value); // value can be string or array
JsonLd::setType($type); // type of twitter card tag
JsonLd::setTitle($type); // title of twitter card tag
JsonLd::setSite($type); // site of twitter card tag
JsonLd::setDescription($type); // description of twitter card tag
JsonLd::setUrl($type); // url of twitter card tag
JsonLd::setImage($url); // add image url

// You can chain methods
JsonLd::addValue($key, $value)
    ->setType($type)
    ->setImage($url)
    ->setTitle($title)
    ->setDescription($description)
    ->setUrl($url)
    ->setSite($name);

// Generate html tags
JsonLd::generate();
```

#### API (SEO)

> Facilitates access to all the SEO Providers

```php
<?php

use Artesaos\SEOTools\Facades\SEOTools;

SEOTools::metatags();
SEOTools::twitter();
SEOTools::opengraph();
SEOTools::jsonLd();

SEOTools::setTitle($title);
SEOTools::getTitle($session = false);
SEOTools::setDescription($description);
SEOTools::setCanonical($url);
SEOTools::addImages($urls);
```

Missing Features
----------------

There are many SEO-related features, which you may need for your project. While this package provides support for the basic ones,
other are out of its scope. You'll have to use separated packages fot their integration.

### SiteMap

This package does not support sitemap files generation. Please consider usage one of the following packages for it:

- [laravelium/sitemap](https://packagist.org/packages/laravelium/sitemap)

- [spatie/laravel-sitemap](https://packagist.org/packages/spatie/laravel-sitemap)

### URL Trailing Slash

This package does not handle URL consistency regardless absence or presence of the slash symbol at its end.
Please consider usage one of the following packages if you need it:

- [illuminatech/url-trailing-slash](https://packagist.org/packages/illuminatech/url-trailing-slash)

- [fsasvari/laravel-trailing-slash](https://packagist.org/packages/fsasvari/laravel-trailing-slash)

### Microdata Markup

This package does provide generation of the [microdata HTML markup](https://www.w3.org/TR/microdata/). If you need to create HTML like the following one:

```html
<div itemscope>
 <p>My name is
  <span itemprop="name">Elizabeth</span>.</p>
</div>
```

you will need to handle it yourself.

> Note: nowadays microdata markup is considered to be outdated. It is recommened to use [JSON Linked Data](https://json-ld.org/) instead,
  which is supported by this extension.

### RSS

This package does not support RSS feed generation or related meta data composition. Please consider usage one of the following packages for it:

- [spatie/laravel-feed](https://packagist.org/packages/spatie/laravel-feed)
