<?php

namespace Anh\Paginator\View;

use Anh\Paginator\PageInterface;

class SimpleView extends AbstractView
{
    protected $templates = array(
        'centered' => '<div class="pagination-centered">%paginator%</div>',
        'paginator' => '<ul class="pagination">%paginator%</ul>',
        'page' => '<li><a href="%url%">%page%</a></li>',
        'current_page' => '<li class="current"><a href="%url%">%page%</a></li>',
        'navigation' => '%prev%%paginator%%next%',
        'arrow' => '<li class="arrow"><a href="%url%">%arrow%</a></li>',
        'arrow_unavailable' => '<li class="arrow unavailable"><a href="">%arrow%</a></li>',
    );

    protected $options = array(
        'centered' => false,
        'navigation' => true,
        'arrow_prev' => '&laquo;',
        'arrow_next' => '&raquo;',
    );

    public function render(PageInterface $page, $url, array $options = array())
    {
        $options += $this->options;
        $currentPage = $page->getPageNumber();
        $pagesCount = $page->getPagesCount();

        $paginator = $this->renderPages(
            array(1, $pagesCount),
            $currentPage,
            $url
        );

        if ($options['navigation']) {
            $paginator = $this->renderNavigation($paginator, $currentPage, $pagesCount, $url, $options);
        }

        $paginator = $this->process(
            $this->templates['paginator'],
            array(
                '%paginator%' => $paginator,
            )
        );

        if ($options['centered']) {
            $paginator = $this->renderCentered($paginator);
        }

        return $paginator;
    }

    protected function process($template, $values)
    {
        return str_replace(array_keys($values), array_values($values), $template);
    }

    protected function renderPage($pageNumber, $currentPage, $url)
    {
        return $this->process(
            $pageNumber == $currentPage ? $this->templates['current_page'] : $this->templates['page'],
            array(
                '%page%' => $pageNumber,
                '%url%' => $this->urlGenerator->generate($pageNumber, $url),
            )
        );
    }

    protected function renderPages(array $pages, $currentPage, $url)
    {
        $html = '';

        for ($page = $pages[0]; $page <= $pages[1]; $page++) {
            $html .= $this->renderPage($page, $currentPage, $url);
        }

        return $html;
    }

    protected function renderCentered($paginator)
    {
        return $this->process(
            $this->templates['centered'],
            array(
                '%paginator%' => $paginator,
            )
        );
    }

    protected function renderNavigation($paginator, $currentPage, $pagesCount, $url, $options)
    {
        return $this->process(
            $this->templates['navigation'],
            array(
                '%paginator%' => $paginator,
                '%prev%' => $this->renderPrev($currentPage, $url, $options),
                '%next%' => $this->renderNext($currentPage, $pagesCount, $url, $options),
            )
        );
    }

    protected function renderPrev($currentPage, $url, array $options)
    {
        return $this->process(
            $currentPage <= 1 ? $this->templates['arrow_unavailable'] : $this->templates['arrow'],
            array(
                '%arrow%' => $options['arrow_prev'],
                '%url%' => $this->urlGenerator->generate($currentPage - 1, $url),
            )
        );
    }

    protected function renderNext($currentPage, $pagesCount, $url, array $options)
    {
        return $this->process(
            $currentPage >= $pagesCount ? $this->templates['arrow_unavailable'] : $this->templates['arrow'],
            array(
                '%arrow%' => $options['arrow_next'],
                '%url%' => $this->urlGenerator->generate($currentPage + 1, $url),
            )
        );
    }
}
