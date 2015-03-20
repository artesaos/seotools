<?php namespace Artesaos\SEOTools\Providers;

use Artesaos\SEOTools\SEOMeta;
use Artesaos\SEOTools\OpenGraph;
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

        $this->app->singleton('seotools.opengraph', function ($app) {
            return new OpenGraph($app['config']->get('seotools.opengraph', []));
        });

        $this->app->singleton('seotools.twitter', function ($app) {
            return new TwitterCards($app['config']->get('seotools.twitter.defaults', []));
        });

        $this->app->singleton('seotools', function ($app) {
            return new SEOTools($app);
        });

        $this->app->bind('Artesaos\SEOTools\Contracts\MetaTags', 'Artesaos\SEOTools\MetaTags');
        $this->app->bind('Artesaos\SEOTools\Contracts\OpenGraph', 'Artesaos\SEOTools\OpenGraph');
        $this->app->bind('Artesaos\SEOTools\Contracts\Twitter', 'Artesaos\SEOTools\TwitterCards');
        $this->app->bind('Artesaos\SEOTools\Contracts\SEOTools', 'Artesaos\SEOTools\SEOTools');

        
        \Blade::extend(function($view, $compiler)
        {
            $pattern = $compiler->createPlainMatcher('SEOMeta');  
            return preg_replace($pattern, '<?php echo SEOMeta::generate(); ?>', $view);
        });
        
        \Blade::extend(function($view, $compiler)
        {
            $pattern = $compiler->createPlainMatcher('OpenGraph');  
            return preg_replace($pattern, '<?php echo OpenGraph::generate(); ?>', $view);
        });
        
        \Blade::extend(function($view, $compiler)
        {
            $pattern = $compiler->createPlainMatcher('Twitter');  
            return preg_replace($pattern, '<?php echo Twitter::generate(); ?>', $view);
        });

        \Blade::extend(function($view, $compiler)
        {
            $pattern = $compiler->createPlainMatcher('SEO');             
            return preg_replace($pattern, '<?php echo SEO::generate(); ?>', $view);
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