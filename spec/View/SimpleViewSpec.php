<?php

namespace spec\Anh\Paginator\View;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\PageInterface;

class SimpleViewSpec extends ObjectBehavior
{
    public function let(PageInterface $page)
    {
        $page->getPageNumber()->willReturn(1);
        $page->getPagesCount()->willReturn(2);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\View\SimpleView');
    }

    public function it_should_render(PageInterface $page)
    {
        $this->render($page, '')->shouldReturn(
            '<ul class="pagination">' .
                '<li class="arrow unavailable"><a href="">&laquo;</a></li>' .
                '<li class="current"><a href="1">1</a></li>' .
                '<li><a href="2">2</a></li>' .
                '<li class="arrow"><a href="2">&raquo;</a></li>' .
            '</ul>'
        );
    }

    public function it_should_render_without_navigation(PageInterface $page)
    {
        $this->render($page, '', array('navigation' => false))->shouldReturn(
            '<ul class="pagination">' .
                '<li class="current"><a href="1">1</a></li>' .
                '<li><a href="2">2</a></li>' .
            '</ul>'
        );
    }

    public function it_should_render_centered(PageInterface $page)
    {
        $this->render($page, '', array('centered' => true))->shouldReturn(
            '<div class="pagination-centered">' .
                '<ul class="pagination">' .
                    '<li class="arrow unavailable"><a href="">&laquo;</a></li>' .
                    '<li class="current"><a href="1">1</a></li>' .
                    '<li><a href="2">2</a></li>' .
                    '<li class="arrow"><a href="2">&raquo;</a></li>' .
                '</ul>' .
            '</div>'
        );
    }
}
