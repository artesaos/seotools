<?php

namespace spec\Artesaos\SEOTools;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SEOMetaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Artesaos\SEOTools\SEOMeta');
    }
}
