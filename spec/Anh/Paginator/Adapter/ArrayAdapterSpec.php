<?php

namespace spec\Anh\Paginator\Adapter;

use PhpSpec\ObjectBehavior;

class ArrayAdapterSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(range(1, 10));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Adapter\ArrayAdapter');
    }

    public function it_should_implement_AdapterInterface()
    {
        $this->shouldImplement('Anh\Paginator\AdapterInterface');
    }

    public function it_should_be_compatible_with_array()
    {
        $this->shouldBeCompatibleWith(array(1, 2, 3));
    }

    public function it_should_not_be_compatible_with_other_types()
    {
        $this->shouldNotBeCompatibleWith('not compatible data');
    }

    public function it_should_create_iterator()
    {
        $this->createIterator(0, 4)->shouldImplement('Iterator');
    }

    public function it_should_return_paginated_data()
    {
        $this->createIterator(0, 4)->shouldBeLike(
            new \ArrayIterator(array(1, 2, 3, 4))
        );
    }

    public function it_should_return_total_count()
    {
        $this->getTotalCount()->shouldReturn(10);
    }
}
