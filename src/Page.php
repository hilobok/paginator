<?php

namespace Anh\Paginator;

class Page implements PageInterface
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Current page
     * @var integer
     */
    protected $page;

    /**
     * Rows per page
     * @var integer
     */
    protected $limit;

    /**
     * Paginated data
     * @var array|Iterator
     */
    private $data;

    /**
     * Constructor
     * @param AdapterInterface $adapter
     * @param integer          $page    Page number to retrieve, numeration starting from 1
     * @param integer          $limit   Number of elements per page
     */
    public function __construct(AdapterInterface $adapter, $page, $limit)
    {
        $this->adapter = $adapter;
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        if ($this->data === null) {
            $this->data = $this->adapter->getResult(
                $this->getOffset(),
                $this->getLimit()
            );
        }

        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getOffset()
    {
        return ($this->getPage() - 1) * $this->getLimit();
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
    public function getPage()
    {
        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return $this->adapter->getCount();
    }

    /**
     * {@inheritdoc}
     */
    public function getPagesCount()
    {
        return (integer) ceil($this->getCount() / $this->getLimit());
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->getCount() === 0;
    }
}
