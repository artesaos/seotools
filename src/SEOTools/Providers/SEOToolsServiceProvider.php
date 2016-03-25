<?php

namespace Artesaos\SEOTools\Providers;

use Artesaos\SEOTools\Contracts;
use Artesaos\SEOTools\OpenGraph;
use Artesaos\SEOTools\SEOMeta;
use Artesaos\SEOTools\SEOTools;
use Artesaos\SEOTools\TwitterCards;
use Illuminate\Support\ServiceProvider;

class SEOToolsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->app->singleton('seotools.metatags', function ($app) {
            return new SEOMeta($app['config']->get('seotools.meta', []));
        });

        $this->app->singleton('seotools.opengraph', function ($app) {
            return new OpenGraph($app['config']->get('seotools.opengraph', []));
        });

        $this->app->singleton('seotools.twitter', function ($app) {
            return new TwitterCards($app['config']->get('seotools.twitter.defaults', []));
        });

        $this->app->singleton('seotools', function () {
            return new SEOTools();
        });

        $this->app->bind(Contracts\MetaTags::class, 'seotools.metatags');
        $this->app->bind(Contracts\OpenGraph::class, 'seotools.opengraph');
        $this->app->bind(Contracts\TwitterCards::class, 'seotools.twitter');
        $this->app->bind(Contracts\SEOTools::class, 'seotools');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Contracts\SEOTools::class,
            Contracts\MetaTags::class,
            Contracts\TwitterCards::class,
            Contracts\OpenGraph::class,
            'seotools',
            'seotools.metatags',
            'seotools.opengraph',
            'seotools.twitter',
        ];
    }

    /**
     * @return bool
     */
    private function isLumen()
    {
        return true === str_contains($this->app->version(), 'Lumen');
    }
}
