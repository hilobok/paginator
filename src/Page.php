<?php

namespace Anh\Paginator;

class Page implements PageInterface, \IteratorAggregate, \Countable
{
    /**
     * Dataset adapter.
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Page number.
     * @var integer
     */
    protected $pageNumber;

    /**
     * Number of elements per page.
     * @var integer
     */
    protected $limit;

    /**
     * Iterator for paginated data.
     * @var \ArrayIterator
     */
    protected $iterator;

    /**
     * Total number of elements in dataset.
     * @var integer
     */
    protected $totalCount;

    /**
     * Offset in dataset for given page number.
     * @var integer
     */
    protected $offset;

    /**
     * Total number of pages.
     * @var integer
     */
    protected $pagesCount;

    /**
     * Number of elements in paginated data.
     * @var integer
     */
    protected $count;

    /**
     * Constructor
     * @param AdapterInterface $adapter    Dataset adapter.
     * @param integer          $pageNumber Page number to retrieve, numeration starting from 1.
     * @param integer          $limit      Number of elements per page.
     */
    public function __construct(AdapterInterface $adapter, $pageNumber, $limit)
    {
        $this->adapter = $adapter;
        $this->pageNumber = $pageNumber ?: 1;
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->iterator ?: $this->iterator = $this->adapter->createIterator(
            $this->getOffset(),
            $this->limit
        );
    }

    /**
     * Returns number of elements in iterator.
     * @return integer
     */
    public function count()
    {
        return isset($this->count) ? $this->count
            : $this->count = count($this->getIterator())
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getOffset()
    {
        return isset($this->offset) ? $this->offset
            : $this->offset = ($this->pageNumber - 1) * $this->limit
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * {@inheritdoc}
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCount()
    {
        return isset($this->totalCount) ? $this->totalCount
            : $this->totalCount = $this->adapter->getTotalCount()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getPagesCount()
    {
        return isset($this->pagesCount) ? $this->pagesCount
            : $this->pagesCount = (integer) ceil($this->getTotalCount() / $this->limit)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->getTotalCount() === 0;
    }
}
