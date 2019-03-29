<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\JsonLd;

/**
 * Class TwitterCardsTest.
 */
class JsonLdTest extends BaseTest
{
    /**
     * @var JsonLd
     */
    protected $jsonLd;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->jsonLd = $this->app->make('seotools.json-ld');
    }

    public function test_set_title()
    {
        $this->jsonLd->setTitle('Kamehamehaaaaaaaa');

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","name":"Kamehamehaaaaaaaa"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    public function test_set_site()
    {
        $this->jsonLd->setSite('http://kakaroto.9000');

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","url":"http:\/\/kakaroto.9000"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    public function test_set_url()
    {
        $this->jsonLd->setUrl('http://kakaroto.9000');

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","url":"http:\/\/kakaroto.9000"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    public function test_set_description()
    {
        $this->jsonLd->setDescription('Kamehamehaaaaaaaa');

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","@description":"Kamehamehaaaaaaaa"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    public function test_cleans_description()
    {
        $description = '"Foo bar" -> abc';

        $this->jsonLd->setDescription($description);

        $expected = htmlspecialchars_decode('<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","@description":"\"Foo bar\" -&gt; abc"}</script></head></html>');

        $this->setRightAssertion($expected);
    }

    public function test_set_type()
    {
        $this->jsonLd->setType('sayajin');

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"sayajin"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    public function test_set_images()
    {
        $this->jsonLd->setImages(['sayajin.png', 'namekusei.png']);

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","image":"[\"sayajin.png\",\"namekusei.png\"]"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    public function test_set_image()
    {
        $this->jsonLd->setImage('sayajin.png');

        $expected = '<html><head><script type="application/ld+json">{"@context":"https:\/\/schema.org","image":"sayajin.png"}</script></head></html>';

        $this->setRightAssertion($expected);
    }

    /**
     * @param $expectedString
     */
    protected function setRightAssertion($expectedString)
    {
        $expectedDom = $this->makeDomDocument($expectedString);
        $actualDom = $this->makeDomDocument($this->jsonLd->generate());

        $this->assertEquals($expectedDom->C14N(), $actualDom->C14N());
    }
}
