<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Anh\Paginator\AdapterInterface;

class PageSpec extends ObjectBehavior
{
    public function let(AdapterInterface $adapter)
    {
        $adapter->getTotalCount()->willReturn(51);
        $this->beConstructedWith($adapter, 1, 2);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Page');
    }

    public function it_should_implement_PageInterface()
    {
        $this->shouldImplement('Anh\Paginator\PageInterface');
    }

    public function it_should_implement_IteratorAggregate()
    {
        $this->shouldImplement('IteratorAggregate');
    }

    public function it_should_implement_Countable()
    {
        $this->shouldImplement('Countable');
    }

    public function it_should_return_iterator(AdapterInterface $adapter)
    {
        $adapter->createIterator(Argument::cetera())->shouldBeCalled();
        $this->getIterator();
    }

    public function it_should_return_offset()
    {
        $this->getOffset()->shouldReturn(0);
    }

    public function it_should_return_limit()
    {
        $this->getLimit()->shouldReturn(2);
    }

    public function it_should_return_page_number()
    {
        $this->getPageNumber()->shouldReturn(1);
    }

    public function it_should_return_total_count(AdapterInterface $adapter)
    {
        $this->getTotalCount()->shouldReturn(51);
    }

    public function it_should_return_pages_count(AdapterInterface $adapter)
    {
        $this->getPagesCount()->shouldReturn(26);
    }

    public function it_might_be_empty(AdapterInterface $adapter)
    {
        $adapter->getTotalCount()->willReturn(0);
        $this->shouldBeEmpty();
    }

    public function it_might_be_not_empty(AdapterInterface $adapter)
    {
        $adapter->getTotalCount()->willReturn(5);
        $this->shouldNotBeEmpty();
    }
}
