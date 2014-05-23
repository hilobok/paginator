<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\AdapterInterface;

class PageFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\PageFactory');
    }

    public function it_should_create_page(AdapterInterface $adapter)
    {
        $this->create($adapter, 1, 2)->shouldImplement('Anh\Paginator\PageInterface');
    }
}
