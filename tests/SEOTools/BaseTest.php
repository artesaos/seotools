<?php

namespace Tsawler\SEOTools\Tests;

use Orchestra\Testbench\TestCase;
use Mockery as m;

/**
 * Class BaseTest.
 */
abstract class BaseTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return ['Tsawler\SEOTools\Providers\SEOToolsServiceProvider'];
    }

    /**
     * @param $string
     * @return \DOMDocument
     */
    protected function makeDomDocument($string)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($string);
        return $dom;
    }
}
