<?php namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\SEOTools as SEOContract;
use Illuminate\Contracts\Foundation\Application;

class SEOTools implements SEOContract
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return \Artesaos\SEOTools\Contracts\MetaTags
     */
    public function metatags()
    {
        return $this->app['seotools.metatags'];
    }

    /**
     * @return \Artesaos\SEOTools\Contracts\OpenGraph
     */
    public function opengraph()
    {
        return $this->app['seotools.opengraph'];
    }

    /**
     * @return \Artesaos\SEOTools\Contracts\TwitterCards
     */
    public function twitter()
    {
        return $this->app['seotools.twitter'];
    }

    /**
     * Setup title for all seo providers
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->metatags()->setTitle($title);
        $this->opengraph()->setTitle($title);
        $this->twitter()->setTitle($title);
    }

    /**
     * Setup description for all seo providers
     *
     * @param string $title
     */
    public function setDescription($description)
    {
        $this->metatags()->setDescription($description);
        $this->opengraph()->setDescription($description);
        $this->twitter()->setDescription($description);
    }

    /**
     * Generate from all seo providers
     *
     * @return string
     */
    public function generate()
    {
        $html = $this->metatags()->generate();
        $html .= PHP_EOL;
        $html .= $this->opengraph()->generate();
        $html .= PHP_EOL;
        $html .= $this->twitter()->generate();

        return $html;
    }
}