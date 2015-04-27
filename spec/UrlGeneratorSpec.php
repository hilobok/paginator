<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\UrlGenerator;

class UrlGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\UrlGenerator');
    }

    public function it_will_replace_placeholder_with_given_page_number()
    {
        $this->generate(1, sprintf('/some/url/%s/blah', UrlGenerator::PLACEHOLDER))
            ->shouldReturn('/some/url/1/blah')
        ;
    }

    public function it_will_add_page_number_to_the_end_of_the_given_url_if_no_placeholder()
    {
        $this->generate(2, '/some/url/')->shouldReturn('/some/url/2');
    }
}
