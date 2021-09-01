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
    protected function setUp(): void
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
        $fullHeader = '<title>' . $fullTitle . '</title>';
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->setTitle('Kamehamehaaaaaaaa');

        $this->assertEquals($fullTitle, $this->seoMeta->getTitle());
        $this->setRightAssertion($fullHeader);
    }

    public function test_set_title_without_append_default()
    {
        $fullTitle = 'Kamehamehaaaaaaaa';
        $fullHeader = '<title>' . $fullTitle . '</title>';
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->setTitle($fullTitle, false);

        $this->assertEquals($fullTitle, $this->seoMeta->getTitle());
        $this->setRightAssertion($fullHeader);
    }

    public function test_set_default_title()
    {
        $fullTitle = 'Kamehamehaaaaaaaa';
        $fullHeader = '<title>' . $fullTitle . '</title>';
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
        $fullHeader .= "<meta name=\"description\" content=\"" . $description . '">';

        $this->seoMeta->setDescription($description);

        $this->assertEquals($description, $this->seoMeta->getDescription());
        $this->setRightAssertion($fullHeader);

        $this->seoMeta->setDescription(false);
        $this->assertNull($this->seoMeta->getDescription());
    }

    public function test_cleans_description()
    {
        $description = '"Foo bar" -> abc';

        $this->seoMeta->setDescription($description);

        $this->assertEquals("&quot;Foo bar&quot; -&gt; abc", $this->seoMeta->getDescription());
    }

    public function test_set_keywords()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<meta name=\"keywords\" content=\"masenko,makankosappo\">";
        $keywords = 'masenko,makankosappo';

        $this->seoMeta->setKeywords($keywords);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($keywords, implode(',', $this->seoMeta->getKeywords()));
    }

    public function test_add_keywords()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<meta name=\"keywords\" content=\"masenko, makankosappo\">";

        $this->seoMeta->addKeyword('masenko');
        $this->seoMeta->addKeyword('makankosappo');

        $this->setRightAssertion($fullHeader);
        $this->assertEquals('masenko, makankosappo', implode(', ', $this->seoMeta->getKeywords()));

        $this->seoMeta->addKeyword(['kienzan', 'tayoken']);

        $this->assertEquals('kienzan, tayoken, masenko, makankosappo', implode(', ', $this->seoMeta->getKeywords()));
    }

    public function test_remove_metatag()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->seoMeta->addMeta('no-content');
        $this->seoMeta->addMeta(['custom-meta' => 'value']);
        $this->seoMeta->addMeta('custom-meta', 'value', 'test');

        $fullHeaderWithTags = $fullHeader . "<meta test=\"custom-meta\" content=\"value\">";
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

    public function dataTestUrls()
    {
        return [
            ['http://localhost/hello/world', 'http://localhost/hello/world'],
            ['http://localhost/hello/world?param=1', 'http://localhost/hello/world'],
        ];
    }

    /**
     * @dataProvider dataTestUrls
     */
    public function test_get_canonical_null($fullUrl)
    {
        config()->set('defaults.canonical', null);
        $this->seoMeta = new SEOMeta(config());

        $this->get($fullUrl);
        $this->assertEquals($fullUrl, $this->seoMeta->getCanonical());
    }

    /**
     * @dataProvider dataTestUrls
     */
    public function test_get_canonical_full($fullUrl)
    {
        config()->set('defaults.canonical', 'full');
        $this->seoMeta = new SEOMeta(config());

        $this->get($fullUrl);
        $this->assertEquals($fullUrl, $this->seoMeta->getCanonical());
    }

    /**
     * @dataProvider dataTestUrls
     */
    public function test_get_canonical_current($fullUrl, $currentUrl)
    {
        config()->set('defaults.canonical', 'current');
        $this->seoMeta = new SEOMeta(config());

        $this->get($fullUrl);
        $this->assertEquals($currentUrl, $this->seoMeta->getCanonical());
    }

    public function test_set_amp()
    {
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $fullHeader .= "<link rel=\"amphtml\" href=\"http://domain.com/amp\"/>";
        $amphtml = 'http://domain.com/amp';

        $this->seoMeta->setAmpHtml($amphtml);

        $this->setRightAssertion($fullHeader);
        $this->assertEquals($amphtml, $this->seoMeta->getAmpHtml());
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

        $this->assertEquals(array_merge($expectedLangs, $expectedLangs), $this->seoMeta->getAlternateLanguages());
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
        $this->seoMeta->setRobots('all');
        $this->seoMeta->reset();

        $this->setRightAssertion($expected);
    }

    /**
     * @param $expectedString
     */
    protected function setRightAssertion($expectedString)
    {
        $expectedDom = $this->makeDomDocument($expectedString);
        $actualDom = $this->makeDomDocument($this->seoMeta->generate(true));

        $this->assertEquals($expectedDom->C14N(), str_replace(["\n", "\r"], '', $actualDom->C14N()));
    }

    public function test_it_sets_default_meta_robots_to_none()
    {
        $this->assertEquals(null, $this->seoMeta->getRobots());
    }

    public function test_it_allows_setting_meta_robots()
    {
        $this->seoMeta->setRobots('all');
        $this->assertEquals('all', $this->seoMeta->getRobots());

        $expected = "<title>It's Over 9000!</title>";
        $expected .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";
        $expected .= "<meta name=\"robots\" content=\"all\">";

        $this->setRightAssertion($expected);
    }

    /**
     * @depends test_set_description
     * @see     https://github.com/artesaos/seotools/issues/122
     */
    public function test_utf8()
    {
        $description = 'de fidélisation des salariés';
        $fullHeader = "<title>It's Over 9000!</title>";
        $fullHeader .= "<meta name=\"description\" content=\"" . $description . '">';

        $this->seoMeta->setDescription($description);

        $this->assertEquals($description, $this->seoMeta->getDescription());
        $this->setRightAssertion($fullHeader);
    }

    public function test_it_can_add_notranslate_class_to_title()
    {
        $this->seoMeta = new SEOMeta(new \Illuminate\Config\Repository([
            'add_notranslate_class' => true,
            'defaults'              => [
                'title'       => 'It\'s Over 9000!',
                'description' => 'For those who helped create the Genki Dama',
            ],
        ]));

        $expected = "<title class=\"notranslate\">It's Over 9000!</title>";
        $expected .= "<meta name=\"description\" content=\"For those who helped create the Genki Dama\">";

        $this->setRightAssertion($expected);
    }
}
