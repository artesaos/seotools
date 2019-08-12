<?php

namespace Artesaos\SEOTools\Providers;

use Illuminate\Support\Str;
use Artesaos\SEOTools\JsonLd;
use Artesaos\SEOTools\SEOMeta;
use Artesaos\SEOTools\SEOTools;
use Artesaos\SEOTools\Contracts;
use Artesaos\SEOTools\OpenGraph;
use Artesaos\SEOTools\TwitterCards;
use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\Support\DeferrableProvider;

class SEOToolsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $configFile = __DIR__.'/../../resources/config/seotools.php';

        if ($this->isLumen()) {
            $this->app->configure('seotools');
        } else {
            $this->publishes([
                $configFile => config_path('seotools.php'),
            ]);
        }

        $this->mergeConfigFrom($configFile, 'seotools');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('seotools.metatags', function($app) {
            return new SEOMeta(new Config($app['config']->get('seotools.meta', [])));
        });

        $this->app->singleton('seotools.opengraph', function($app) {
            return new OpenGraph($app['config']->get('seotools.opengraph', []));
        });

        $this->app->singleton('seotools.twitter', function($app) {
            return new TwitterCards($app['config']->get('seotools.twitter.defaults', []));
        });

        $this->app->singleton('seotools.json-ld', function($app) {
            return new JsonLd($app['config']->get('seotools.json-ld.defaults', []));
        });

        $this->app->singleton('seotools', function() {
            return new SEOTools();
        });

        $this->app->bind(Contracts\MetaTags::class, 'seotools.metatags');
        $this->app->bind(Contracts\OpenGraph::class, 'seotools.opengraph');
        $this->app->bind(Contracts\TwitterCards::class, 'seotools.twitter');
        $this->app->bind(Contracts\JsonLd::class, 'seotools.json-ld');
        $this->app->bind(Contracts\SEOTools::class, 'seotools');
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [
            Contracts\SEOTools::class,
            Contracts\MetaTags::class,
            Contracts\TwitterCards::class,
            Contracts\OpenGraph::class,
            Contracts\JsonLd::class,
            'seotools',
            'seotools.metatags',
            'seotools.opengraph',
            'seotools.twitter',
            'seotools.json-ld',
        ];
    }

    /**
     * @return bool
     */
    private function isLumen(): bool
    {
        return Str::contains($this->app->version(), 'Lumen');
    }
}
