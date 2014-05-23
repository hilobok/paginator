<?php

namespace Anh\Paginator;

interface PageInterface
{
    /**
     * Get paginated elements
     * @return array|Iterator
     */
    public function get();

    /**
     * Get offset
     * @return integer
     */
    public function getOffset();

    /**
     * Get number of elements per page
     * @return integer
     */
    public function getLimit();

    /**
     * Get page number
     * @return integer
     */
    public function getPage();

    /**
     * Get total number of elements
     * @return integer
     */
    public function getCount();

    /**
     * Get total pages count
     * @return integer
     */
    public function getPagesCount();

    /**
     * Indicates whether page has any elements
     * @return boolean
     */
    public function isEmpty();
}
