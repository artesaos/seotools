<?php

namespace Apility\SEOTools\Tests;

/**
 * Class SEOToolsServiceProviderTest.
 */
class SEOToolsServiceProviderTest extends BaseTest
{
    /**
     * Verify if classes are in service container.
     *
     * @dataProvider bindsListProvider
     *
     * @param string $contract
     * @param string $concreteClass
     */
    public function test_container_are_provided($contract, $concreteClass)
    {
        $this->assertInstanceOf(
            $contract,
            $this->app[$concreteClass]
        );
    }

    /**
     * @return array
     */
    public function bindsListProvider()
    {
        return [
            [
                'Apility\SEOTools\Contracts\MetaTags',
                'Apility\SEOTools\SEOMeta',
            ],
            [
                'Apility\SEOTools\Contracts\OpenGraph',
                'Apility\SEOTools\OpenGraph',
            ],
            [
                'Apility\SEOTools\Contracts\SEOTools',
                'Apility\SEOTools\SEOTools',
            ],
            [
                'Apility\SEOTools\Contracts\TwitterCards',
                'Apility\SEOTools\TwitterCards',
            ],
            [
                'Apility\SEOTools\Contracts\JsonLd',
                'Apility\SEOTools\JsonLd',
            ],
            [
                'Apility\SEOTools\Contracts\JsonLdMulti',
                'Apility\SEOTools\JsonLdMulti',
            ],
        ];
    }
}
