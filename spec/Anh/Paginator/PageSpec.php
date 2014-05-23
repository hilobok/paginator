<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\AdapterInterface;

class PageSpec extends ObjectBehavior
{
    public function let(AdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter, 1, 2);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Page');
    }

    public function it_should_implement_interface()
    {
        $this->shouldImplement('Anh\Paginator\PageInterface');
    }

    public function it_should_get_paginated_data(AdapterInterface $adapter)
    {
        $adapter->getResult(0, 2)->willReturn(array(10, 20));
        $this->get()->shouldReturn(array(10, 20));
    }

    public function it_should_get_offset()
    {
        $this->getOffset()->shouldReturn(0);
    }

    public function it_should_get_limit()
    {
        $this->getLimit()->shouldReturn(2);
    }

    public function it_should_get_page()
    {
        $this->getPage()->shouldReturn(1);
    }

    public function it_should_get_count(AdapterInterface $adapter)
    {
        $adapter->getCount()->willReturn(100);
        $this->getCount()->shouldReturn(100);
    }

    public function it_should_get_pages_count(AdapterInterface $adapter)
    {
        $adapter->getCount()->willReturn(51);
        $this->getPagesCount()->shouldReturn(26);
    }

    public function it_might_be_empty(AdapterInterface $adapter)
    {
        $adapter->getCount()->willReturn(0);
        $this->shouldBeEmpty();
    }

    public function it_might_be_not_empty(AdapterInterface $adapter)
    {
        $adapter->getCount()->willReturn(5);
        $this->shouldNotBeEmpty();
    }
}
