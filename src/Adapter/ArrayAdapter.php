<?php

namespace Anh\Paginator\Adapter;

use Anh\Paginator\AdapterInterface;

class ArrayAdapter implements AdapterInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var boolean
     */
    protected $preserveKeys;

    public function __construct(array $data, $preserveKeys = false)
    {
        $this->data = $data;
        $this->preserveKeys = $preserveKeys;
    }

    /**
     * {@inheritdoc}
     */
    public function getResult($offset, $limit)
    {
        return array_slice($this->data, $offset, $limit, $this->preserveKeys);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
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
