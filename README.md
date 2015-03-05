# SEOTools - SEO Tools for Laravel

SEOTools is a package for **Laravel 5** that provides helpers for some common SEO techniques.

> Current Build Status 

[![Build Status](https://travis-ci.org/artesaos/seotools.svg)](https://travis-ci.org/artesaos/seotools)
[![Code Climate](https://codeclimate.com/github/artesaos/seotools/badges/gpa.svg)](https://codeclimate.com/github/artesaos/seotools)

> Statistics

[![Latest Stable Version](https://poser.pugx.org/artesaos/seotools/v/stable.svg)](https://packagist.org/packages/artesaos/seotools) [![Total Downloads](https://poser.pugx.org/artesaos/seotools/downloads.svg)](https://packagist.org/packages/artesaos/seotools) [![Latest Unstable Version](https://poser.pugx.org/artesaos/seotools/v/unstable.svg)](https://packagist.org/packages/artesaos/seotools) [![License](https://poser.pugx.org/artesaos/seotools/license.svg)](https://packagist.org/packages/artesaos/seotools)

> Tips

<a href="http://zenhub.io" target="_blank"><img src="https://raw.githubusercontent.com/ZenHubIO/support/master/zenhub-badge.png" height="18px" alt="Powered by ZenHub"/></a>

## Features
- friendly interface
- Ease of set titles and meta tags

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

### 3 - Facade
In order to use the `SEOMeta` facade, you need to register it on the `config/app.php` file, you can do that the following way:

```php
// file START ommited
    'aliases' => [
        // other Facades ommited
        'SEOMeta'   => 'Artesaos\SEOTools\Facades\SEOMeta',
        'OpenGraph' => 'Artesaos\SEOTools\Facades\OpenGraph',
    ],
// file END ommited
```
## 4 - Usage
### Meta tags Generator
With **SEOMeta** you can create meta tags to the `head`  

### Opengraph tags Generator
With **OpenGraph** you can create opengraph tags to the `head`  

#### In your controller
```php
use SEOMeta;

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
        
        OpenGraph::setDescription($post->title);
        OpenGraph::setTitle($post->resume);
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        
        OpenGraph::addImage($post->cover->url);
        OpenGraph::addImage($post->images->list('url));
        OpenGraph::addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);

        return view('myshow', compact('post'));
    }
}
```

### In Your View

```html
<html>
<head>
	{!! SEOMeta::generate() !!}
	{!! OpenGraph::generate() !!}
</head>
<body>

</body>
</html>
```

```html
<html>
<head>
	<title>Title - SubTitle</title>
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
</head>
<body>

</body>
</html>
```

#### Configuration 
In `seotools.php` configuration file you can determine the properties of the default values and some behaviors.
- meta
 - **defaults** - What values are displayed if not specified any value for the page display. If the value is `false`, nothing is displayed.
 - **webmaster** - Are the settings of tags values for major webmaster tools. If you are `null` nothing is displayed.
- opengraph
 - **defaults** - Are the properties that will always be displayed and when no other value is set instead. **You can add additional tags** that are not included in the original configuration file.

#### API (SEOMeta)
```php
SEOMeta::setTitle($title);
SEOMeta::setDescription($description);
SEOMeta::setKeywords($keywords);
SEOMeta::addKeyword($keyword);
SEOMeta::addMeta($meta, $value = null, $name = 'name');

// You can concatenate methods
SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setKeywords($keywords)
            ->addKeyword($keyword)
            ->addMeta($meta, $value);

// Retrieving data
SEOMeta::getTitle();
SEOMeta::getTitleSession();
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

// You can concatenate methods
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