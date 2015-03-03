<?php

namespace spec\Artesaos\SEOTools;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OpenGraphSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Artesaos\SEOTools\OpenGraph');
    }
}
