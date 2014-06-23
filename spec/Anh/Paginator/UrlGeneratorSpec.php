<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Anh\Paginator\UrlGenerator;

class UrlGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\UrlGenerator');
    }

    function it_will_replace_placeholder_with_given_page_number()
    {
        $this->generate(1, sprintf('/some/url/%s/blah', UrlGenerator::PLACEHOLDER))
            ->shouldReturn('/some/url/1/blah')
        ;
    }

    function it_will_add_page_number_to_the_end_of_the_given_url_if_no_placeholder()
    {
        $this->generate(2, '/some/url/')->shouldReturn('/some/url/2');
    }
}
