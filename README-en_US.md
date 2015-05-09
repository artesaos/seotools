# SEOTools - SEO Tools for Laravel and Lumen

SEOTools is a package for **Laravel 5** and **Lumen** that provides helpers for some common SEO techniques.

> Current Build Status

[![Build Status](https://travis-ci.org/artesaos/seotools.svg)](https://travis-ci.org/artesaos/seotools)
[![Code Climate](https://codeclimate.com/github/artesaos/seotools/badges/gpa.svg)](https://codeclimate.com/github/artesaos/seotools)
[![Codacy Badge](https://www.codacy.com/project/badge/36bce2b4929e4f3387d26b8a26e5c667)](https://www.codacy.com/app/luiz-vinicius73/seotools)

> Statistics

[![Latest Stable Version](https://poser.pugx.org/artesaos/seotools/v/stable)](https://packagist.org/packages/artesaos/seotools) [![Total Downloads](https://poser.pugx.org/artesaos/seotools/downloads)](https://packagist.org/packages/artesaos/seotools) [![Latest Unstable Version](https://poser.pugx.org/artesaos/seotools/v/unstable)](https://packagist.org/packages/artesaos/seotools) [![License](https://poser.pugx.org/artesaos/seotools/license)](https://packagist.org/packages/artesaos/seotools)

> Tips

<a href="http://zenhub.io" target="_blank"><img src="https://raw.githubusercontent.com/ZenHubIO/support/master/zenhub-badge.png" height="18px" alt="Powered by ZenHub"/></a>

## Features
- friendly interface
- Ease of set titles and meta tags
- Ease of set metas for twitter and opengraph

## Installation
### 1 - Dependency
The first step is using composer to install the package and automatically update your `composer.json` file, you can do this by running:
```shell
composer require artesaos/seotools
```

### 2 - Provider
You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
// file START ommited
    'providers' => [
        // other providers ommited
        'Artesaos\SEOTools\Providers\SEOToolsServiceProvider',
    ],
// file END ommited
```

#### Lumen
Go to `/bootstrap/app.php` file and add this line:

```php
// file START ommited
	$app->register('Artesaos\SEOTools\Providers\SEOToolsServiceProvider');
// file END ommited
```

### 3 - Facade

> Facades are not supported in Lumen.

In order to use the `SEOMeta` facade, you need to register it on the `config/app.php` file, you can do that the following way:

```php
// file START ommited
    'aliases' => [
        // other Facades ommited
        'SEOMeta'   => 'Artesaos\SEOTools\Facades\SEOMeta',
        'OpenGraph' => 'Artesaos\SEOTools\Facades\OpenGraph',
        'Twitter' => 'Artesaos\SEOTools\Facades\Twitter',
        // or
        'SEO' => 'Artesaos\SEOTools\Facades\SEOTools',
    ],
// file END ommited
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

## 5 - Usage

> Facades are not supported in Lumen.

### Lumen Usage

```php
$seotools = app('seotools');
$metatags = app('seotools.metatags');
$twitter = app('seotools.twitter');
$opengraph = app('seotools.opengraph');

// The behavior is the same as the facade
// --------

echo app('seotools')->generate();

```

### Meta tags Generator
With **SEOMeta** you can create meta tags to the `head`

### Opengraph tags Generator
With **OpenGraph** you can create opengraph tags to the `head`

### Twitter for Twitter Cards tags Generator
With **Twitter** you can create opengraph tags to the `head`

#### In your controller
```php
use SEOMeta;
use OpenGraph;
use Twitter;
## or
use SEO;

class CommomController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        SEOMeta::setTitle('Home');
        SEOMeta::setDescription('This is my page description');

        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'articles');
        
        Twitter::setTitle('Homepage');
        Twitter::setSite('@LuizVinicius73');
        
        ## Or
        
        SEO::setTitle('Home');
        SEO::setDescription('This is my page description');
        SEO::opengraph()->setUrl('http://current.url.com');
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@LuizVinicius73');
        
        $posts = Post::all();

        return view('myindex', compact('posts'));
    }

    /**
     * @return \Illuminate\View\View
     */
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

        return view('myshow', compact('post'));
    }
}
```

#### SEOTrait

```php
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class CommomController extends Controller
{
    use SEOToolsTrait;

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->seo()->setTitle('Home');
        $this->seo()->setDescription('This is my page description');
        $this->seo()->opengraph()->setUrl('http://current.url.com');
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->twitter()->setSite('@LuizVinicius73');
        
        $posts = Post::all();

        return view('myindex', compact('posts'));
    }
}
```

### In Your View

```html
<html>
<head>
	{!! SEOMeta::generate() !!}
	{!! OpenGraph::generate() !!}
	{!! Twitter::generate() !!}
	    <!-- OR -->
	{!! SEO::generate() !!}
	
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

</head>
<body>

</body>
</html>
```

#### API (SEOMeta)
```php
SEOMeta::SetTitleSeparator($seperator);
SEOMeta::setTitle($title);
SEOMeta::setDescription($description);
SEOMeta::setKeywords($keywords);
SEOMeta::addKeyword($keyword);
SEOMeta::addMeta($meta, $value = null, $name = 'name');

// You can chain methods
SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setKeywords($keywords)
            ->addKeyword($keyword)
            ->addMeta($meta, $value);

// Retrieving data
SEOMeta::getTitle();
SEOMeta::getTitleSession();
SEOMeta::getTitleSeperator();
SEOMeta::getKeywords();
SEOMeta::getDescription();
SEOMeta::reset();

SEOMeta::generate();
```

#### API (OpenGraph)
```php
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
Twitter::addValue($key, $value); // value can be string or array
Twitter::setType($type); // type of twitter card tag
Twitter::setTitle($type); // title of twitter card tag
Twitter::setSite($type); // site of twitter card tag
Twitter::setDescription($type); // description of twitter card tag
Twitter::setUrl($type); // url of twitter card tag
Twitter::addImage($url); // add image url
Twitter::addImages($url); // add an array of url images

// You can chain methods
Twitter::addValue($key, $value)
            ->setType($type)
            ->addImage($url)
            ->addImages($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setSite($name);

// Generate html tags
Twitter::generate();
```

#### API (SEO)
> Facilitates access to all the SEO Providers

```php
SEO::metatags();
SEO::twitter();
SEO::opengraph();

SEO::setTitle($title);
SEO::setDescription($description);
```
