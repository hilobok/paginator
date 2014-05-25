<?php

namespace Anh\Paginator;

class PageFactory
{
    const DEFAULT_PAGE_CLASS = 'Anh\Paginator\Page';

    /**
     * Page class.
     * @var string
     */
    protected $pageClass;

    /**
     * Constructor
     * @param string $pageClass Page class.
     */
    public function __construct($pageClass = self::DEFAULT_PAGE_CLASS)
    {
        $this->pageClass = $pageClass;
    }

    /**
     * Creates page.
     * @param  AdapterInterface $adapter Dataset adapter.
     * @param  integer          $page    Page number to retrieve, numeration starts from 1.
     * @param  integer          $limit   Number of elements per page.
     * @return PageInterface
     */
    public function create(AdapterInterface $adapter, $page, $limit)
    {
        return new $this->pageClass($adapter, $page, $limit);
    }
}
