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
        'SEOMeta' => 'Artesaos\SEOTools\Facades\SEOMeta',
    ],
// file END ommited
```
## Usage
### 1 - Metatags Generator
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

        return view('myshow', compact('post'));
    }
}
```

#### In Your View

```html
<html>
<head>
	{!! SEOMeta::generate() !!}
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
</head>
<body>

</body>
</html>
```

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
