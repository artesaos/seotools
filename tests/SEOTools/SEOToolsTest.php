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

        $expected = "<title>Kamehamehaaaaaaa - It's Over 9000!</title>";
        $expected .= '<meta name="description" content="For those who helped create the Genki Dama">';
        $expected .= '<meta property="og:title" content="Kamehamehaaaaaaa" />';
        $expected .= '<meta property="og:description" content="For those who helped create the Genki Dama" />';
        $expected .= '<meta name="twitter:title" content="Kamehamehaaaaaaa" />';

        $this->assertEquals('Kamehamehaaaaaaa - It\'s Over 9000!', $this->seoTools->getTitle());
        $this->setRightAssertion($expected);
    }

    public function test_set_description()
    {
        $this->seoTools->setDescription('Kamehamehaaaaaaa');

        $expected = "<title>It's Over 9000!</title>";
        $expected .= '<meta name="description" content="Kamehamehaaaaaaa">';
        $expected .= '<meta property="og:description" content="Kamehamehaaaaaaa" />';
        $expected .= '<meta property="og:title" content="Over 9000 Thousand!" />';
        $expected .= '<meta name="twitter:description" content="Kamehamehaaaaaaa" />';


        $this->setRightAssertion($expected);
    }

    public function test_set_canonical()
    {
        $this->seoTools->setCanonical('http://domain.com');

        $expected = "<title>It's Over 9000!</title>";
        $expected .= '<meta name="description" content="For those who helped create the Genki Dama">';
        $expected .= '<link rel="canonical" href="http://domain.com"/>';
        $expected .= '<meta property="og:title" content="Over 9000 Thousand!" />';
        $expected .= '<meta property="og:description" content="For those who helped create the Genki Dama" />';

        $this->setRightAssertion($expected);
    }

    public function test_add_images()
    {
        $this->seoTools->addImages(['Kamehamehaaaaaaa.png']);
        $this->seoTools->addImages('Kamehamehaaaaaaa.png');

        $expected = "<title>It's Over 9000!</title>";
        $expected .= '<meta name="description" content="For those who helped create the Genki Dama">';
        $expected .= '<meta property="og:title" content="Over 9000 Thousand!" />';
        $expected .= '<meta property="og:description" content="For those who helped create the Genki Dama" />';
        $expected .= '<meta property="og:image" content="Kamehamehaaaaaaa.png" />';
        $expected .= '<meta property="og:image" content="Kamehamehaaaaaaa.png" />';
        $expected .= '<meta name="twitter:images0" content="Kamehamehaaaaaaa.png" />';
        $expected .= '<meta name="twitter:images1" content="Kamehamehaaaaaaa.png" />';

        $this->setRightAssertion($expected);
    }

    public function test_generate()
    {
        $expected = "<title>It's Over 9000!</title>";
        $expected .= '<meta name="description" content="For those who helped create the Genki Dama">';
        $expected .= '<meta property="og:title" content="Over 9000 Thousand!" />';
        $expected .= '<meta property="og:description" content="For those who helped create the Genki Dama" />';

        $this->setRightAssertion($expected);
    }

    /**
     * @param $expectedString
     */
    protected function setRightAssertion($expectedString)
    {
        $expectedDom = $this->makeDomDocument($expectedString);
        $actualDom = $this->makeDomDocument($this->seoTools->generate());

        $this->assertEquals($expectedDom->C14N(), $actualDom->C14N());
    }
}
