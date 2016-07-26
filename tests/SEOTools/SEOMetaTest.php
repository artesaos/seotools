<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\SEOMeta;

/**
 * Class SEOMetaTest.
 */
class SEOMetaTest extends BaseTest
{
    /**
     * @var SEOMeta
     */
    protected $seoMeta;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoMeta = $this->app->make('seotools.metatags');
    }

    public function test_generate()
    {
        $expected = "<title>It's Over 9000!</title>";
        $expected .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->setRightAssertion($expected);
    }

    public function test_set_title_with_append_default()
    {
        $fullTitle = "Kamehamehaaaaaaaa - It's Over 9000!";
        $fullHeader = '<title>' .$fullTitle. '</title>';
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->setTitle('Kamehamehaaaaaaaa');

        $this->assertEquals($fullTitle, $this->seoMeta->getTitle());
        $this->setRightAssertion($fullHeader);
    }

    public function test_set_title_without_append_default()
    {
        $fullTitle = 'Kamehamehaaaaaaaa';
        $fullHeader = '<title>' .$fullTitle. '</title>';
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->setTitle($fullTitle, false);

        $this->assertEquals($fullTitle, $this->seoMeta->getTitle());
        $this->setRightAssertion($fullHeader);
    }

    public function test_set_default_title()
    {
        $fullTitle = 'Kamehamehaaaaaaaa';
        $fullHeader = '<title>' .$fullTitle. '</title>';
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->setTitleDefault($fullTitle);

        $this->assertEquals($fullTitle, $this->seoMeta->getDefaultTitle());
        $this->setRightAssertion($fullHeader);
    }

    public function test_set_title_sepatator()
    {
        $fullHeader = "<title>Kamehamehaaaaaaaa | It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $separator = ' | ';
        $fullTitle = 'Kamehamehaaaaaaaa';

        $this->seoMeta->setTitleSeparator($separator);
        $this->seoMeta->setTitle($fullTitle);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($separator, $this->seoMeta->getTitleSeparator());
    }

    public function test_set_description()
    {
        $description = 'Kamehamehaaaaaaaa';
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"".$description.'">';

        $this->seoMeta->setDescription($description);

        $this->assertEquals($description, $this->seoMeta->getDescription());
        $this->setRightAssertion($fullHeader);

        $this->seoMeta->setDescription(false);
        $this->assertNull($this->seoMeta->getDescription());
    }

    public function test_set_keywords()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<meta name=\"keywords\" content=\"masenko,makankosappo\">";
        $keywords = 'masenko,makankosappo';

        $this->seoMeta->setKeywords($keywords);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($keywords, implode($this->seoMeta->getKeywords(), ','));
    }

    public function test_add_keywords()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<meta name=\"keywords\" content=\"masenko, makankosappo\">";

        $this->seoMeta->addKeyword('masenko');
        $this->seoMeta->addKeyword('makankosappo');

        $this->setRightAssertion($fullHeader);
        $this->assertEquals('masenko, makankosappo', implode($this->seoMeta->getKeywords(), ', '));

        $this->seoMeta->addKeyword(['kienzan','tayoken']);

        $this->assertEquals('kienzan, tayoken, masenko, makankosappo', implode($this->seoMeta->getKeywords(), ', '));

    }

    public function test_remove_metatag()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->addMeta('no-content');
        $this->seoMeta->addMeta(['custom-meta' => 'value']);
        $this->seoMeta->addMeta('custom-meta', 'value', 'test');

        $fullHeaderWithTags = $fullHeader."<meta test=\"custom-meta\" content=\"value\">";
        $this->setRightAssertion($fullHeaderWithTags);

        $this->seoMeta->removeMeta('custom-meta');
        $this->seoMeta->removeMeta('no-content');

        $this->setRightAssertion($fullHeader);
        $this->assertEquals(count([]), count($this->seoMeta->getMetatags()));
    }

    public function test_set_canonical()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<link rel=\"canonical\" href=\"http://domain.com\"/>";
        $canonical = 'http://domain.com';

        $this->seoMeta->setCanonical($canonical);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($canonical, $this->seoMeta->getCanonical());
    }

    public function test_set_next()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<link rel=\"next\" href=\"http://domain.com\"/>";
        $next = 'http://domain.com';

        $this->seoMeta->setNext($next);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($next, $this->seoMeta->getNext());
    }

    public function test_set_prev()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<link rel=\"prev\" href=\"http://domain.com\"/>";
        $prev = 'http://domain.com';

        $this->seoMeta->setPrev($prev);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($prev, $this->seoMeta->getPrev());
    }

    public function test_set_alternate_languages()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<link rel=\"alternate\" hreflang=\"en\" href=\"http://domain.com\"/>";
        $lang = 'en';
        $langUrl = 'http://domain.com';

        $expectedLangs = [['lang' => $lang, 'url' => $langUrl]];
        $this->seoMeta->addAlternateLanguage($lang, $langUrl);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($expectedLangs, $this->seoMeta->getAlternateLanguages());

        $this->seoMeta->addAlternateLanguages($expectedLangs);

        $this->assertEquals(array_merge($expectedLangs,$expectedLangs), $this->seoMeta->getAlternateLanguages());
    }

    public function test_set_reset()
    {
        $expected = "<title>It's Over 9000!</title>";
        $expected .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->setDescription('test');
        $this->seoMeta->addKeyword('test');
        $this->seoMeta->setNext('test');
        $this->seoMeta->setPrev('test');
        $this->seoMeta->setCanonical('test');
        $this->seoMeta->addMeta('test');
        $this->seoMeta->addAlternateLanguage('test', 'test');
        $this->seoMeta->reset();

        $this->setRightAssertion($expected);
    }

    /**
     * @param $expectedString
     */
    protected function setRightAssertion($expectedString)
    {
        $expectedDom = $this->makeDomDocument($expectedString);
        $actualDom = $this->makeDomDocument($this->seoMeta->generate());

        $this->assertEquals($expectedDom->C14N(), $actualDom->C14N());
    }
}
