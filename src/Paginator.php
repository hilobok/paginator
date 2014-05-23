<?php

namespace Anh\Paginator;

class Paginator
{
    /**
     * @var AdapterGuesser
     */
    protected $adapterGuesser;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Constructor
     * @param AdapterGuesser $adapterGuesser
     * @param PageFactory    $pageFactory
     */
    public function __construct($adapterGuesser = null, $pageFactory = null)
    {
        $this->adapterGuesser = $adapterGuesser ?: new AdapterGuesser();
        $this->pageFactory = $pageFactory ?: new PageFactory();
    }

    /**
     * Paginate given data
     * @param  mixed         $data  Data for pagination
     * @param  integer       $page  Page number
     * @param  integer       $limit Number of elements per page
     * @return PageInterface
     */
    public function paginate($data, $page, $limit)
    {
        $adapter = $this->adapterGuesser->guess($data);

        if (!$adapter instanceof AdapterInterface) {
            throw new \InvalidArgumentException(
                sprintf("Unable to guess adapter for '%s'.", is_object($data) ? get_class($data) : gettype($data))
            );
        }

        return $this->pageFactory->create($adapter, $page, $limit);
    }
}
