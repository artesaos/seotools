<?php

namespace Artesaos\SEOTools\Tests;

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
        return ['Artesaos\SEOTools\Providers\SEOToolsServiceProvider'];
    }

    /**
     * @param $str
     * @return string
     */
    protected function removeBreakLines($str)
    {
        return str_replace(array("\r", "\n"), '', $str);
    }
}
