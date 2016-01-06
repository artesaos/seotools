<?php

namespace spec\Artesaos\SEOTools;

use PhpSpec\ObjectBehavior;

class SEOMetaSpec extends ObjectBehavior
{
    public function let()
    {
        $config = [
            'defaults'       => [
                'title'       => false,
                'description' => false,
                'separator'   => ' - ',
                'keywords'    => [],
                ],
            ];

        $this->beConstructedWith($config);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Artesaos\SEOTools\SEOMeta');
    }

    public function it_return_empty_when_title_and_description_is_false()
    {
        $this->generate()->shouldBeString();
        $this->generate()->shouldBeLike('');
    }
}
