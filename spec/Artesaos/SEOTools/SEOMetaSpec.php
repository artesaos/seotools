<?php

namespace spec\Tsawler\SEOTools;

use Illuminate\Config\Repository as Config;
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

        $this->beConstructedWith(new Config($config));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Tsawler\SEOTools\SEOMeta');
    }

    public function it_return_empty_when_title_and_description_is_false()
    {
        $this->generate()->shouldBeString();
        $this->generate()->shouldBeLike('');
    }
}
