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
     * @var Iterator
     */
    private $iterator;

    /**
     * Constructor
     * @param AdapterInterface $adapter Dataset adapter.
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
        return count($this->getIterator());
    }

    /**
     * {@inheritdoc}
     */
    public function getOffset()
    {
        return ($this->pageNumber - 1) * $this->limit;
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
        return $this->adapter->getTotalCount();
    }

    /**
     * {@inheritdoc}
     */
    public function getPagesCount()
    {
        return (integer) ceil($this->getTotalCount() / $this->limit);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->getTotalCount() === 0;
    }
}
