<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Anh\Paginator\AdapterGuesser;
use Anh\Paginator\AdapterInterface;
use Anh\Paginator\PageFactory;

class PaginatorSpec extends ObjectBehavior
{
    public function let(AdapterGuesser $adapterGuesser, PageFactory $pageFactory)
    {
        $this->beConstructedWith($adapterGuesser, $pageFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Paginator');
    }

    public function it_should_guess_adapter(AdapterGuesser $adapterGuesser, AdapterInterface $adapter)
    {
        $adapterGuesser->guess(array())->willReturn($adapter)->shouldBeCalled();
        $this->paginate(array(), 1, 2);
    }

    public function it_will_throw_exception_when_unable_to_guess_adapter(AdapterGuesser $adapterGuesser)
    {
        $adapterGuesser->guess(Argument::any())->willReturn(null);
        $this->shouldThrow('InvalidArgumentException')->during(
            'paginate', array(array(), 1, 2)
        );
    }

    public function it_should_create_page(AdapterGuesser$adapterGuesser, PageFactory $pageFactory, AdapterInterface $adapter)
    {
        $adapterGuesser->guess(array())->willReturn($adapter);
        $pageFactory->create($adapter, 1, 2)->shouldBeCalled();
        $this->paginate(array(), 1, 2);
    }
}
