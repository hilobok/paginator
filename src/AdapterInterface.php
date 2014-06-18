<?php

namespace Anh\Paginator;

interface AdapterInterface
{
    /**
     * Creates iterator for paginated data.
     * @param  integer        $offset Offset in dataset.
     * @param  integer        $limit  Number of elements per page.
     * @return \ArrayIterator
     */
    public function createIterator($offset, $limit);

    /**
     * Returns total number of elements in dataset.
     * @return integer
     */
    public function getTotalCount();

    /**
     * Returns whether adapter supports given dataset.
     * @param  mixed   $data Data for pagination.
     * @return boolean
     */
    public static function isCompatibleWith($data);
}
