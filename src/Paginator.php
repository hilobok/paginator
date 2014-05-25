<?php

namespace Anh\Paginator;

class Paginator
{
    /**
     * @var AdapterResolver
     */
    protected $adapterResolver;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Constructor
     * @param AdapterResolver $adapterResolver
     * @param PageFactory    $pageFactory
     */
    public function __construct($adapterResolver = null, $pageFactory = null)
    {
        $this->adapterResolver = $adapterResolver ?: new AdapterResolver();
        $this->pageFactory = $pageFactory ?: new PageFactory();
    }

    /**
     * Paginate given data.
     * @param  mixed         $data    Data for pagination.
     * @param  integer       $pageNumber    Page number, numeration starts from 1.
     * @param  integer       $limit   Number of elements per page.
     * @param  array         $options Adapter options.
     * @return PageInterface
     */
    public function paginate($data, $pageNumber, $limit, array $options = array())
    {
        $adapter = $this->adapterResolver->resolve($data, $options);

        if (!$adapter instanceof AdapterInterface) {
            throw new \InvalidArgumentException(
                sprintf("Unable to resolve adapter for '%s'.", is_object($data) ? get_class($data) : gettype($data))
            );
        }

        return $this->pageFactory->create($adapter, $pageNumber, $limit);
    }
}
