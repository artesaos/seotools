<?php

namespace spec\Artesaos\SEOTools;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Artesaos\SEOTools\SEOMeta;

class SEOMetaSpec extends ObjectBehavior
{
    function let()
    {
        $config = [
            'defaults'       => [
                'title'       => false,
                'description' => false,
                'separator'   => ' - ',
                'keywords'    => [],
                ]
            ];
        
        $this->beConstructedWith($config);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Artesaos\SEOTools\SEOMeta');
    }
    
    function it_return_empty_when_title_and_description_is_false()
    {
         $this->generate()->shouldBeString();
         $this->generate()->shouldBeLike('');
    }
}
