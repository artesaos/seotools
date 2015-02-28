<?php namespace Artesaos\SEOTools\Providers;

use Artesaos\SEOTools\SEOMeta;
use Illuminate\Support\ServiceProvider;

class SEOToolsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../resources/config/seotools.php' => config_path('seotools.php')
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../../resources/config/seotools.php', 'seotools'
        );
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

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}