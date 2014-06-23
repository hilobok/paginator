<?php

namespace Anh\Paginator\View;

use Anh\Paginator\PageInterface;

class AdaptiveView extends SimpleView
{
    public function __construct($urlGenerator = null)
    {
        parent::__construct($urlGenerator);

        $this->setTemplates(array(
            'delimiter' => '<li class="unavailable"><a href="">%delimiter%</a></li>',
        ));

        $this->setOptions(array(
            'delimiter' => '&hellip;',
            'length' => 4,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function render(PageInterface $page, $url, array $options = array())
    {
        $options += $this->options;
        $pagesCount = $page->getPagesCount();

        if ($pagesCount <= $options['length'] * 3 + 1) {
            return parent::render($page, $url, $options);
        }

        $currentPage = $page->getPageNumber();

        $delimiter = $this->process(
            $this->templates['delimiter'],
            array(
                '%delimiter%' => $options['delimiter'],
            )
        );

        switch (true) {
            case ($currentPage < $options['length'] * 2):
                $sequence = array(
                    array(array(1, $options['length'] * 2), $currentPage, $url),
                    $delimiter,
                    array(array($pagesCount - $options['length'] + 1, $pagesCount), $currentPage, $url),
                );
                break;

            case ($currentPage > ($pagesCount - $options['length'] * 2 + 1)):
                $sequence = array(
                    array(array(1, $options['length']), $currentPage, $url),
                    $delimiter,
                    array(array($pagesCount - $options['length'] * 2 + 1, $pagesCount), $currentPage, $url),
                );
                break;

            default:
                $sequence = array(
                    array(array(1, 1), $currentPage, $url),
                    $delimiter,
                    array(array($currentPage - $options['length'], $currentPage + $options['length']), $currentPage, $url),
                    $delimiter,
                    array(array($pagesCount, $pagesCount), $currentPage, $url),
                );
                break;
        }

        $paginator = $this->renderSequence($sequence);

        if ($options['navigation']) {
            $paginator = $this->process(
                $this->templates['navigation'],
                array(
                    '%paginator%' => $paginator,
                    '%prev%' => $this->renderPrev($currentPage, $url, $options),
                    '%next%' => $this->renderNext($currentPage, $pagesCount, $url, $options),
                )
            );
        }

        $paginator = $this->process(
            $this->templates['paginator'],
            array(
                '%paginator%' => $paginator,
            )
        );

        if ($options['centered']) {
            $paginator = $this->process(
                $this->templates['centered'],
                array(
                    '%paginator%' => $paginator,
                )
            );
        }

        return $paginator;
    }

    protected function renderSequence(array $sequence)
    {
        $html = '';

        foreach ($sequence as $value) {
            if (is_string($value)) {
                $html .= $value;
            }

            if (is_array($value)) {
                $html .= call_user_func_array(array($this, 'renderPages'), $value);
            }
        }

        return $html;
    }
}
