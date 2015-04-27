<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\AdapterResolver;
use Anh\Paginator\AdapterInterface;
use Anh\Paginator\PageFactory;

class PaginatorSpec extends ObjectBehavior
{
    public function let(AdapterResolver $adapterResolver, PageFactory $pageFactory)
    {
        $this->beConstructedWith($adapterResolver, $pageFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Paginator');
    }

    public function it_should_resolve_adapter(AdapterResolver $adapterResolver, AdapterInterface $adapter)
    {
        $adapterResolver->resolve(array(), array())
            ->willReturn($adapter)
            ->shouldBeCalled()
        ;
        $this->paginate(array(), 1, 2);
    }

    public function it_will_throw_exception_when_unable_to_resolve_adapter(AdapterResolver $adapterResolver)
    {
        $adapterResolver->resolve(array(), array())
            ->willReturn(null)
            ->shouldBeCalled()
        ;
        $this->shouldThrow('InvalidArgumentException')->during(
            'paginate', array(array(), 1, 2)
        );
    }

    public function it_should_create_page(AdapterResolver $adapterResolver, PageFactory $pageFactory, AdapterInterface $adapter)
    {
        $adapterResolver->resolve(array(), array())
            ->willReturn($adapter)
        ;
        $pageFactory->create($adapter, 1, 2)
            ->shouldBeCalled()
        ;
        $this->paginate(array(), 1, 2);
    }
}
