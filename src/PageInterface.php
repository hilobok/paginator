<?php

namespace Anh\Paginator;

/**
 * Page instances besides this interface should implement also \IteratorAggregate and \Countable.
 */
interface PageInterface
{
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
