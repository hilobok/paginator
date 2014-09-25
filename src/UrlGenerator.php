<?php

namespace Anh\Paginator;

class UrlGenerator
{
    const PLACEHOLDER = '%page%';

    /**
     * Returns url for given page number.
     * If url contains placeholder, it will be replaced with given page number.
     * If placeholder absent, page number will be added to the end of the string.
     * @param  integer $pageNumber Page number.
     * @param  string  $url        Url template.
     * @return string  Url for given page number.
     */
    public function generate($pageNumber, $url)
    {
        if (strpos($url, self::PLACEHOLDER) !== false) {
            return str_replace(self::PLACEHOLDER, $pageNumber, $url);
        }

        return sprintf('%s%d', $url, $pageNumber);
    }
}
