<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\OpenGraph;

/**
 * Class OpenGraph Test.
 */
class OpenGraphTest extends BaseTest
{
    /**
     * @var $openGraphs
     */
    protected $openGraphs;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->openGraphs = $this->app->make('seotools.opengraph');
    }

    public function test_set_title_and_description()
    {
        $this->openGraphs->setTitle('Hello, Ali');
        $this->openGraphs->setDescription('This is a test by Ali.');

        $expected = '<meta property="og:title" content="Hello, Ali" /><meta property="og:description" content="This is a test by Ali." />';

        $this->setRightAssertion($expected);

    }

    public function test_set_url()
    {
        $this->openGraphs->setUrl('https://www.domain.com');

        $expected = '<meta property="og:title" content="Over 9000 Thousand!" /><meta property="og:description" content="For those who helped create the Genki Dama" /><meta content="https://www.domain.com" property="og:url">';

        $this->setRightAssertion($expected);

    }

    public function test_can_generate_tags_from_array()
    {
        $tags = ['Example', 'tags', 'test'];

        $this->openGraphs->setType('article');
        $this->openGraphs->setArticle([
            "tag" => $tags,
        ]);

        $expected = '<meta content="article" property="og:type"><meta property="og:title" content="Over 9000 Thousand!" /><meta property="og:description" content="For those who helped create the Genki Dama" /><meta property="article:tag" content="Example" /><meta property="article:tag" content="tags" /><meta property="article:tag" content="test" />';

        $this->setRightAssertion($expected);
    }

    /**
     * @param $expectedString
     */
    protected function setRightAssertion($expectedString)
    {
        $expectedDom = $this->makeDomDocument($expectedString);
        $actualDom   = $this->makeDomDocument($this->openGraphs->generate(true));

        $this->assertEquals($expectedDom->C14N(), str_replace(["\n", "\r"], '', $actualDom->C14N()));
    }

}
