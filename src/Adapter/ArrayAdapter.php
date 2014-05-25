<?php

namespace Anh\Paginator\Adapter;

use Anh\Paginator\AdapterInterface;

class ArrayAdapter implements AdapterInterface
{
    /**
     * Data for pagination.
     * @var array
     */
    protected $data;

    /**
     * Adapter options.
     * @var array
     */
    private $options;

    /**
     * Constructor
     * @param array $data    Data for pagination.
     * @param array $options Adapter options.
     */
    public function __construct(array $data, array $options = array())
    {
        $this->options = $options + array(
            'preserveKeys' => false
        );

        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function createIterator($offset, $limit)
    {
        return new \ArrayIterator(
            array_slice(
                $this->data,
                $offset,
                $limit,
                $this->options['preserveKeys']
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCount()
    {
        return count($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public static function isCompatibleWith($data)
    {
        return is_array($data);
    }
}
