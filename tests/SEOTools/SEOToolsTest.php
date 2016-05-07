<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\Contracts\MetaTags;
use Artesaos\SEOTools\Contracts\OpenGraph;
use Artesaos\SEOTools\Contracts\TwitterCards;
use Artesaos\SEOTools\SEOTools;

/**
 * Class SEOToolsTest.
 */
class SEOToolsTest extends BaseTest
{
    /**
     * @var SEOTools
     */
    protected $seoTools;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoTools = $this->app->make('seotools');
    }

    public function test_metatag_instance()
    {
        $this->assertInstanceOf(MetaTags::class, $this->seoTools->metatags());
    }

    public function test_opengraph_instance()
    {
        $this->assertInstanceOf(OpenGraph::class, $this->seoTools->opengraph());
    }

    public function test_twitter_instance()
    {
        $this->assertInstanceOf(TwitterCards::class, $this->seoTools->twitter());
    }

    public function test_set_title()
    {
        $this->seoTools->setTitle('Kamehamehaaaaaaa');

        $expected = '<title>Kamehamehaaaaaaa - It\'s Over 9000!</title>';
        $expected .= PHP_EOL;
        $expected .= '<meta name="description" content="For those who helped create the Genki Dama">';
        $expected .= PHP_EOL;
        $expected .= '<meta property="og:title" content="Kamehamehaaaaaaa" />';
        $expected .= PHP_EOL;
        $expected .= '<meta property="og:description" content="For those who helped create the Genki Dama" />';
        $expected .= PHP_EOL;
        $expected .= PHP_EOL;
        $expected .= '<meta name="twitter:title" content="Kamehamehaaaaaaa" />';

        $this->assertEquals($expected, $this->seoTools->generate());
    }

    public function test_set_description()
    {
        $this->seoTools->setDescription('Kamehamehaaaaaaa');

        $expected = '<title>It\'s Over 9000!</title>';
        $expected .= PHP_EOL;
        $expected .= '<meta name="description" content="Kamehamehaaaaaaa">';
        $expected .= PHP_EOL;
        $expected .= '<meta property="og:description" content="Kamehamehaaaaaaa" />';
        $expected .= PHP_EOL;
        $expected .= '<meta property="og:title" content="Over 9000 Thousand!" />';
        $expected .= PHP_EOL;
        $expected .= PHP_EOL;
        $expected .= '<meta name="twitter:description" content="Kamehamehaaaaaaa" />';

        
        $this->assertEquals($expected, $this->seoTools->generate());
    }

    public function test_generate()
    {
        $expected = '<title>It\'s Over 9000!</title>';
        $expected .= PHP_EOL;
        $expected .= '<meta name="description" content="For those who helped create the Genki Dama">';
        $expected .= PHP_EOL;
        $expected .= '<meta property="og:title" content="Over 9000 Thousand!" />';
        $expected .= PHP_EOL;
        $expected .= '<meta property="og:description" content="For those who helped create the Genki Dama" />';
        $expected .= PHP_EOL;
        $expected .= PHP_EOL;

        $this->assertEquals($expected, $this->seoTools->generate());
    }
}
