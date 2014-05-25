<?php

namespace Anh\Paginator;

interface PageInterface
{
    /**
     * Returns iterator for paginated elements. It should implement Iterator and Countable interfaces.
     * @return Iterator
     */
    public function getIterator();

    /**
     * Returns offset in dataset for given page number.
     * @return integer
     */
    public function getOffset();

    /**
     * Returns number of elements per page.
     * @return integer
     */
    public function getLimit();

    /**
     * Returns page number.
     * @return integer
     */
    public function getPageNumber();

    /**
     * Returns total number of elements in dataset.
     * @return integer
     */
    public function getTotalCount();

    /**
     * Returns total pages count.
     * @return integer
     */
    public function getPagesCount();

    /**
     * Returns whether page is empty.
     * @return boolean
     */
    public function isEmpty();
}
