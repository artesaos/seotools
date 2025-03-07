<?php

declare(strict_types=1);

namespace Artesaos\SEOTools\Tests\Integrations;

use Artesaos\SEOTools\Integrations\Inertia;
use Artesaos\SEOTools\Tests\BaseTest;

class InertiaTest extends BaseTest
{
    /***
     * @var Inertia
     */
    protected $inertia;
    protected function setUp(): void
    {
        parent::setUp();

        $this->inertia = $this->app->make(Inertia::class);
    }

    public function test_convert_meta_to_inertia_style()
    {
        $seo = '<meta name="keywords" content="viewing, mobile TV, iphone, ipad">';

        $expected = '<meta inertia name="keywords" content="viewing, mobile TV, iphone, ipad">';

        $converted = $this->inertia->convertHeadToInertiaStyle($seo);

        $this->assertEquals($expected, $converted);
    }

    public function test_convert_canonical_link_to_inertia_style()
    {
        $seo = '<link rel="canonical" href="https://www.example.com">';

        $expected = '<link inertia rel="canonical" href="https://www.example.com">';

        $converted = $this->inertia->convertHeadToInertiaStyle($seo);

        $this->assertEquals($expected, $converted);
    }

    public function test_convert_title_to_inertia_style()
    {
        $seo = '<title>Title</title>';

        $expected = '<title inertia>Title</title>';

        $converted = $this->inertia->convertHeadToInertiaStyle($seo);

        $this->assertEquals($expected, $converted);
    }

    public function test_convert_script_to_inertia_style()
    {
        $seo = '<script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"example"}</script>';

        $expected = '<script inertia type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"example"}</script>';

        $converted = $this->inertia->convertHeadToInertiaStyle($seo);

        $this->assertEquals($expected, $converted);
    }
}