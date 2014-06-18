<?php

namespace Anh\Paginator\Adapter;

use Anh\Paginator\AdapterInterface;

class EmptyDataAdapter implements AdapterInterface
{
    /**
     * {@inheritdoc}
     */
    public function createIterator($offset, $limit)
    {
        return new \ArrayIterator(array());
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCount()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public static function isCompatibleWith($data)
    {
        return empty($data) || ($data instanceof \Countable && count($data) === 0);
    }
}
