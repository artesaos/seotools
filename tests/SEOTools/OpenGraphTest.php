<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\Contracts\OpenGraph;

/**
 * Class OpenGraphTest.
 */
class OpenGraphTest extends BaseTest
{
    /**
     * @var OpenGraph
     */
    protected $openGraph;

    public function setUp()
    {
        parent::setUp();

        $this->openGraph = $this->app->make('seotools.opengraph');
    }

    public function test_generate()
    {
        $expected = "<meta property=\"og:title\" content=\"Over 9000 Thousand!\" />";
        $expected .= "<meta property=\"og:description\" content=\"For those who helped create the Genki Dama\" />";
        $this->assertEquals($expected, $this->removeBreakLines($this->openGraph->generate()));
    }

    public function test_set_title()
    {
        $this->openGraph->setTitle('Kamehamehaaaaaaaa');

        $expected = "<meta property=\"og:title\" content=\"Kamehamehaaaaaaaa\" />";
        $expected .= "<meta property=\"og:description\" content=\"For those who helped create the Genki Dama\" />";
        $this->assertEquals($expected, $this->removeBreakLines($this->openGraph->generate()));
    }

    public function test_set_url()
    {
        $this->openGraph->setUrl('http://localhost');

        $expected = "<meta property=\"og:url\" content=\"http://localhost\" />";
        $expected .= "<meta property=\"og:title\" content=\"Over 9000 Thousand!\" />";
        $expected .= "<meta property=\"og:description\" content=\"For those who helped create the Genki Dama\" />";
        $this->assertEquals($expected, $this->removeBreakLines($this->openGraph->generate()));
    }

    public function test_set_article()
    {
        $this->openGraph->setArticle([
            'published_time' => (new \DateTime()),
            'modified_time' => (new \DateTime()),
            'expiration_time' => (new \DateTime()),
            'author' => 'profile / array',
            'section' => 'section',
            'tag' => ['tag1', 'tag2']
        ]);

        $expected = "<meta property=\"og:title\" content=\"Over 9000 Thousand!\" />";
        $expected .= "<meta property=\"og:description\" content=\"For those who helped create the Genki Dama\" />";
        $this->assertEquals($expected, $this->removeBreakLines($this->openGraph->generate()));
    }

    public function test_set_profile()
    {
        $this->openGraph->setProfile([
            'first_name' => 'string',
            'last_name' => 'string',
            'username' => 'string',
            'gender' => 'male'
        ]);

        $expected = "<meta property=\"og:title\" content=\"Over 9000 Thousand!\" />";
        $expected .= "<meta property=\"og:description\" content=\"For those who helped create the Genki Dama\" />";
        $this->assertEquals($expected, $this->removeBreakLines($this->openGraph->generate()));
    }

    public function test_set_type()
    {
        $this->openGraph->setType('article');

        $expected = "<meta property=\"og:type\" content=\"article\" />";
        $expected .= "<meta property=\"og:title\" content=\"Over 9000 Thousand!\" />";
        $expected .= "<meta property=\"og:description\" content=\"For those who helped create the Genki Dama\" />";
        $this->assertEquals($expected, $this->removeBreakLines($this->openGraph->generate()));
    }
}
