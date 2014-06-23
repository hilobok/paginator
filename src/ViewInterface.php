<?php

namespace Anh\Paginator;

interface ViewInterface
{
    public function render(PageInterface $page, $url, array $options = array());
}
