<?php

namespace spec\Anh\Paginator\Adapter;

use PhpSpec\ObjectBehavior;

class EmptyDataAdapterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Adapter\EmptyDataAdapter');
    }

    public function it_should_implement_AdapterInterface()
    {
        $this->shouldImplement('Anh\Paginator\AdapterInterface');
    }

    public function it_should_be_compatible_with_null()
    {
        $this->shouldBeCompatibleWith(null);
    }

    public function it_should_be_compatible_with_empty_array()
    {
        $this->shouldBeCompatibleWith(array());
    }

    public function it_should_be_compatible_with_empty_countable_object()
    {
        $this->shouldBeCompatibleWith(new \ArrayIterator(array()));
    }

    public function it_should_not_be_compatible_with_other_types()
    {
        $this->shouldNotBeCompatibleWith('not compatible data');
    }

    public function it_should_create_iterator()
    {
        $this->createIterator(0, 4)->shouldImplement('Iterator');
    }

    public function it_should_return_empty_iterator()
    {
        $this->createIterator(0, 4)->shouldBeLike(
            new \ArrayIterator(array())
        );
    }

    public function it_should_return_0_as_total_count()
    {
        $this->getTotalCount()->shouldReturn(0);
    }
}
