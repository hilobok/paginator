<?php

namespace spec\Anh\Paginator\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Anh\Paginator\PageInterface;

class AdaptiveViewSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\View\AdaptiveView');
    }

    function it_will_render_simple_view_on_pages_count_less_than_triple_length(PageInterface $page)
    {
        $page->getPageNumber()->willReturn(1);
        $page->getPagesCount()->willReturn(2);

        $this->render($page, '')->shouldReturn(
            '<ul class="pagination">' .
                '<li class="arrow unavailable"><a href="">&laquo;</a></li>' .
                '<li class="current"><a href="1">1</a></li>' .
                '<li><a href="2">2</a></li>' .
                '<li class="arrow"><a href="2">&raquo;</a></li>' .
            '</ul>'
        );
    }

    function it_will_render_head(PageInterface $page)
    {
        $page->getPageNumber()->willReturn(4);
        $page->getPagesCount()->willReturn(20);

        $this->render($page, '')->shouldReturn(
            '<ul class="pagination">' .
                '<li class="arrow"><a href="3">&laquo;</a></li>' .
                '<li><a href="1">1</a></li>' .
                '<li><a href="2">2</a></li>' .
                '<li><a href="3">3</a></li>' .
                '<li class="current"><a href="4">4</a></li>' .
                '<li><a href="5">5</a></li>' .
                '<li><a href="6">6</a></li>' .
                '<li><a href="7">7</a></li>' .
                '<li><a href="8">8</a></li>' .
                '<li class="unavailable"><a href="">&hellip;</a></li>' .
                '<li><a href="17">17</a></li>' .
                '<li><a href="18">18</a></li>' .
                '<li><a href="19">19</a></li>' .
                '<li><a href="20">20</a></li>' .
                '<li class="arrow"><a href="5">&raquo;</a></li>' .
            '</ul>'
        );
    }

    function it_will_render_tail(PageInterface $page)
    {
        $page->getPageNumber()->willReturn(17);
        $page->getPagesCount()->willReturn(20);

        $this->render($page, '')->shouldReturn(
            '<ul class="pagination">' .
                '<li class="arrow"><a href="16">&laquo;</a></li>' .
                '<li><a href="1">1</a></li>' .
                '<li><a href="2">2</a></li>' .
                '<li><a href="3">3</a></li>' .
                '<li><a href="4">4</a></li>' .
                '<li class="unavailable"><a href="">&hellip;</a></li>' .
                '<li><a href="13">13</a></li>' .
                '<li><a href="14">14</a></li>' .
                '<li><a href="15">15</a></li>' .
                '<li><a href="16">16</a></li>' .
                '<li class="current"><a href="17">17</a></li>' .
                '<li><a href="18">18</a></li>' .
                '<li><a href="19">19</a></li>' .
                '<li><a href="20">20</a></li>' .
                '<li class="arrow"><a href="18">&raquo;</a></li>' .
            '</ul>'
        );
    }

    function it_will_render_body(PageInterface $page)
    {
        $page->getPageNumber()->willReturn(8);
        $page->getPagesCount()->willReturn(20);

        $this->render($page, '')->shouldReturn(
            '<ul class="pagination">' .
                '<li class="arrow"><a href="7">&laquo;</a></li>' .
                '<li><a href="1">1</a></li>' .
                '<li class="unavailable"><a href="">&hellip;</a></li>' .
                '<li><a href="4">4</a></li>' .
                '<li><a href="5">5</a></li>' .
                '<li><a href="6">6</a></li>' .
                '<li><a href="7">7</a></li>' .
                '<li class="current"><a href="8">8</a></li>' .
                '<li><a href="9">9</a></li>' .
                '<li><a href="10">10</a></li>' .
                '<li><a href="11">11</a></li>' .
                '<li><a href="12">12</a></li>' .
                '<li class="unavailable"><a href="">&hellip;</a></li>' .
                '<li><a href="20">20</a></li>' .
                '<li class="arrow"><a href="9">&raquo;</a></li>' .
            '</ul>'
        );
    }
}
