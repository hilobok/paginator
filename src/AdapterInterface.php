<?php

namespace Anh\Paginator;

interface AdapterInterface
{
    /**
     * Get paginated data
     * @param  integer        $offset
     * @param  integer        $limit
     * @return array|Iterator
     */
    public function getResult($offset, $limit);

    /**
     * Get total count of elements in data
     * @return integer
     */
    public function getCount();

    /**
     * Indicates whether adapter supports given $data
     * @param  mixed   $data
     * @return boolean
     */
    public static function isCompatibleWith($data);
}
