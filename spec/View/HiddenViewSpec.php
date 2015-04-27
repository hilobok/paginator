<?php

namespace spec\Anh\Paginator\View;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\PageInterface;

class HiddenViewSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\View\HiddenView');
    }

    public function it_should_render(PageInterface $page)
    {
        $page->getPageNumber()->willReturn(1);
        $page->getPagesCount()->willReturn(2);

        $this->render($page, '')->shouldReturn(
            '<ul class="pagination hidden">' .
                '<li class="current"><a href="1">1</a></li>' .
                '<li><a href="2">2</a></li>' .
            '</ul>'
        );
    }
}
