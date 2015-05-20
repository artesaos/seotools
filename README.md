# SEOTools - SEO Tools para Laravel e Lumen

[Readme in English](https://github.com/artesaos/seotools/blob/master/README-en_US.md).

SEOTools é um pacote para **Laravel 5** e **Lumen** que disponibiliza _helpers_ para algumas técnicas comuns de SEO.

> Estado atual do Pacote

[![Build Status](https://travis-ci.org/artesaos/seotools.svg)](https://travis-ci.org/artesaos/seotools)
[![Code Climate](https://codeclimate.com/github/artesaos/seotools/badges/gpa.svg)](https://codeclimate.com/github/artesaos/seotools)
[![Codacy Badge](https://www.codacy.com/project/badge/36bce2b4929e4f3387d26b8a26e5c667)](https://www.codacy.com/app/luiz-vinicius73/seotools)

> Estatísticas

[![Latest Stable Version](https://poser.pugx.org/artesaos/seotools/v/stable)](https://packagist.org/packages/artesaos/seotools) [![Total Downloads](https://poser.pugx.org/artesaos/seotools/downloads)](https://packagist.org/packages/artesaos/seotools) [![Latest Unstable Version](https://poser.pugx.org/artesaos/seotools/v/unstable)](https://packagist.org/packages/artesaos/seotools) [![License](https://poser.pugx.org/artesaos/seotools/license)](https://packagist.org/packages/artesaos/seotools) [![Laravel Brasil no Slack](http://laravelbrasil.vluzrmos.com.br/badge.svg)](http://laravelbrasil.vluzrmos.com.br)

> Dicas

<a href="http://zenhub.io" target="_blank"><img src="https://raw.githubusercontent.com/ZenHubIO/support/master/zenhub-badge.png" height="18px" alt="Powered by ZenHub"/></a>

## Recursos
- Interface amigável
- Facilidade para configurar títulos e meta tags
- Facilidade para configurar meta tags para Twitter e Open Graph (Facebook)

## Instalação
### 1 - Dependência
O primeiro passo é utilizar o [Composer](http://getcomposer.org) para instalar este pacote e atualizar, automaticamente, o seu arquivo `composer.json`, você pode fazer isso executando o seguinte comando:
```shell
composer require artesaos/seotools
```

### 2 - Provider
Você precisa atualizar as configurações da sua aplicação, a fim de registrar o pacote, possibilitando o carregamento pelo seu _framework_.

#### Laravel
Vá até o final do seu arquivo `config/app.php` e adicione esta linha:

```php
// Começo do arquivo omitido
    'providers' => [
        // Outros Providers omitidos
        'Artesaos\SEOTools\Providers\SEOToolsServiceProvider',
    ],
// Final do arquivo omitido
```

#### Lumen
Vá até o seu arquivo `/bootstrap/app.php` e adicione esta linha:

```php
// Começo do arquivo omitido
	$app->register('Artesaos\SEOTools\Providers\SEOToolsServiceProvider');
// Final do arquivo omitido
```

### 3 - Facade

> Facades não são suportados no Lumen.

Para que você possa usar o _Facade_ `SEOMeta`, você precisa registrá-lo no arquivo `config/app.php`, você pode fazer isso da seguinte maneira:

```php
// Começo do arquivo omitido
    'aliases' => [
        // Outros Facades omitidos
        'SEOMeta'   => 'Artesaos\SEOTools\Facades\SEOMeta',
        'OpenGraph' => 'Artesaos\SEOTools\Facades\OpenGraph',
        'Twitter' => 'Artesaos\SEOTools\Facades\Twitter',
        // ou
        'SEO' => 'Artesaos\SEOTools\Facades\SEOTools',
    ],
// Final do arquivo omitido
```


### 4 Configurações

#### Publicar configurações

No seu terminal execute:
```shell
php artisan vendor:publish
```
ou
```shell
php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"
```  

> Lumen não suporta este comando, portanto você precisa copiar o arquivo `src/resources/config/seotools.php` para `config/seotools.php` no seu projeto

No arquivo de configuração `seotools.php` você pode determinar as propriedades dos valores padrão e alguns comportamentos

#### seotools.php

- meta
 - **defaults** - Define os valores que serão exibidos na página acessada, caso nenhum valor seja especificado. Se o valor for `false`, nada é exibido.
 - **webmaster** - Define os valores de configuração para as principais ferramentas de _webmaster_. Se o valor for `null`, nada é exibido.
- opengraph
 - **defaults** - Define as propriedades padrão, que serão exibidas, caso nenhuma outra seja definida. **Você pode adicionar _tags_ adicionais** que não estão inclusas no arquivo original de configuração.
- twitter
 - **defaults** - Define as propriedades padrão, que serão exibidas, caso nenhuma outra seja definida. **Você pode adicionar _tags_ adicionais** que não estão inclusas no arquivo original de configuração.

## 5 - Como usar

### No Lumen
> _Facades_ não são suportados no Lumen.

```php
$seotools = app('seotools');
$metatags = app('seotools.metatags');
$twitter = app('seotools.twitter');
$opengraph = app('seotools.opengraph');

// O resultado é o mesmo que usando Facades
// --------

echo app('seotools')->generate();

```
### No Laravel

##### Gerador de Meta Tags
Com **SEOMeta** você pode gerar meta tags para o `head` da sua página

##### Gerador de _tags_ Open Graph
Com **OpenGraph** você pode gerar tags Open Graph para o `head` da sua página

##### Gerador de Twitter Cards para o Twitter
Com **Twitter** você pode gerar tags Twitter Card para o `head` da sua página

##### No seu _Controller_
```php
use SEOMeta;
use OpenGraph;
use Twitter;
## ou
use SEO;

class CommomController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        SEOMeta::setTitle('Página Inicial');
        SEOMeta::setDescription('Esta é a descrição da minha página');

        OpenGraph::setDescription('Esta é a descrição da minha página');
        OpenGraph::setTitle('Página Inicial');
        OpenGraph::setUrl('http://exemplo.url.com');
        OpenGraph::addProperty('type', 'articles');
        
        Twitter::setTitle('Página Inicial');
        Twitter::setSite('@LuizVinicius73');
        
        ## Ou
        
        SEO::setTitle('Página Inicial');
        SEO::setDescription('Esta é a descrição da minha página');
        SEO::opengraph()->setUrl('http://exemplo.url.com');
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

##### SEOTrait

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
        $this->seo()->setTitle('Página Inicial');
        $this->seo()->setDescription('Esta é a descrição da minha página');
        $this->seo()->opengraph()->setUrl('http://current.url.com');
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->twitter()->setSite('@LuizVinicius73');
        
        $posts = Post::all();

        return view('myindex', compact('posts'));
    }
}
```

##### Na sua _View_

```html
<html>
<head>
	{!! SEOMeta::generate() !!}
	{!! OpenGraph::generate() !!}
	{!! Twitter::generate() !!}
	    <!-- Ou -->
	{!! SEO::generate() !!}
	
	    <!-- Lumen -->
	{!! app('seotools')->generate() !!}
</head>
<body>

</body>
</html>
```
##### Resultado
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

##### API (SEOMeta)
```php
SEOMeta::SetTitleSeparator($seperator);
SEOMeta::setTitle($title);
SEOMeta::setDescription($description);
SEOMeta::setKeywords($keywords);
SEOMeta::addKeyword($keyword);
SEOMeta::addMeta($meta, $value = null, $name = 'name');

// Você pode usar métodos em cadeia
SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setKeywords($keywords)
            ->addKeyword($keyword)
            ->addMeta($meta, $value);

// Obtendo os dados
SEOMeta::getTitle();
SEOMeta::getTitleSession();
SEOMeta::getTitleSeperator();
SEOMeta::getKeywords();
SEOMeta::getDescription();
SEOMeta::reset();

SEOMeta::generate();
```

##### API (Open Graph)
```php
OpenGraph::addProperty($key, $value); // valor pode ser uma string ou array
OpenGraph::addImage($url); // adiciona url da imagem
OpenGraph::addImages($url); // adiciona uma array de urls de imagens
OpenGraph::setTitle($title); // define o título
OpenGraph::setDescription($description);  // define a descrição
OpenGraph::setUrl($url); // define a url
OpenGraph::setSiteName($name); //define site_name

// Você pode usar métodos em cadeia
OpenGraph::addProperty($key, $value)
            ->addImage($url)
            ->addImages($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setSiteName($name);

// Gerar tags html
OpenGraph::generate();
```

##### API (Twitter Card)

```php
Twitter::addValue($key, $value); // valor pode ser uma string ou array
Twitter::setType($type); // tipo da tag do Twitter Card
Twitter::setTitle($type); // título da tag do Twitter Card
Twitter::setSite($type); // site da tag do Twitter Card
Twitter::setDescription($type); // descrição da tag do Twitter Card
Twitter::setUrl($type); // url da tag do Twitter Card
Twitter::addImage($url); // adiciona a url da imagem
Twitter::addImages($url); // adiciona uma array de urls de imagens

// Você pode usar métodos em cadeia
Twitter::addValue($key, $value)
            ->setType($type)
            ->addImage($url)
            ->addImages($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setSite($name);

// Gerar tags html
Twitter::generate();
```

##### API (SEO)
> Facilita o acesso a todos os SEO Providers

```php
SEO::metatags();
SEO::twitter();
SEO::opengraph();

SEO::setTitle($title);
SEO::setDescription($description);
```
