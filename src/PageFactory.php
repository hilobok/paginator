<?php

namespace Anh\Paginator;

class PageFactory
{
    const DEFAULT_PAGE_CLASS = 'Anh\Paginator\Page';

    /**
     * Page class
     * @var string
     */
    protected $class;

    /**
     * Constructor
     * @param string $class Page class
     */
    public function __construct($class = self::DEFAULT_PAGE_CLASS)
    {
        $this->class = $class;
    }

    /**
     * Creates page
     * @param  AdapterInterface $adapter
     * @param  integer          $page    Page number to retrieve, numeration starting from 1
     * @param  integer          $limit   Number of elements per page
     * @return PageInterface
     */
    public function create(AdapterInterface $adapter, $page, $limit)
    {
        return new $this->class($adapter, $page, $limit);
    }
}
