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
        $this->shouldBeCompatibleWith(array());
    }

    public function it_should_not_be_compatible_with_other_types()
    {
        $this->shouldNotBeCompatibleWith('not compatible data');
    }

    public function it_should_get_result()
    {
        $this->getResult(3, 3)->shouldReturn(array(4, 5, 6));
    }

    public function it_should_get_count()
    {
        $this->getCount()->shouldReturn(10);
    }
}
