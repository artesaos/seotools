<?php

namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\SEOTools as SEOContract;

/**
 * SEOTools provides implementation for `SEOTools` contract.
 *
 * @see \Artesaos\SEOTools\Contracts\SEOTools
 */
class SEOTools implements SEOContract
{
    /**
     * {@inheritdoc}
     */
    public function metatags()
    {
        return app('seotools.metatags');
    }

    /**
     * {@inheritdoc}
     */
    public function opengraph()
    {
        return app('seotools.opengraph');
    }

    /**
     * {@inheritdoc}
     */
    public function twitter()
    {
        return app('seotools.twitter');
    }

    /**
     * {@inheritdoc}
     */
    public function jsonLd()
    {
        return app('seotools.json-ld');
    }

    /**
     * {@inheritdoc}
     */
    public function jsonLdMulti()
    {
        return app('seotools.json-ld-multi');
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title, $appendDefault = true)
    {
        $this->metatags()->setTitle($title, $appendDefault);
        $this->opengraph()->setTitle($title);
        $this->twitter()->setTitle($title);
        $this->jsonLd()->setTitle($title);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->metatags()->setDescription($description);
        $this->opengraph()->setDescription($description);
        $this->twitter()->setDescription($description);
        $this->jsonLd()->setDescription($description);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCanonical($url)
    {
        $this->metatags()->setCanonical($url);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addImages($urls)
    {
        if (is_array($urls)) {
            $this->opengraph()->addImages($urls);
        } else {
            $this->opengraph()->addImage($urls);
        }

        $this->twitter()->setImage($urls);

        $this->jsonLd()->addImage($urls);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle($session = false)
    {
        if ($session) {
            return $this->metatags()->getTitleSession();
        }

        return $this->metatags()->getTitle();
    }

    /**
     * {@inheritdoc}
     */
    public function generate($minify = false)
    {
        $html = $this->metatags()->generate();
        $html .= PHP_EOL;
        $html .= $this->opengraph()->generate();
        $html .= PHP_EOL;
        $html .= $this->twitter()->generate();
        $html .= PHP_EOL;
        // if json ld multi is use don't show simple json ld
        $html .= $this->jsonLdMulti()->generate() ?? $this->jsonLd()->generate();

        return ($minify) ? str_replace(PHP_EOL, '', $html) : $html;
    }
}
