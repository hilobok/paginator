<?php

namespace Anh\Paginator\View;

class HiddenView extends SimpleView
{
    public function __construct($urlGenerator = null)
    {
        parent::__construct($urlGenerator);

        $this->setTemplates(array(
            'paginator' => '<ul class="pagination hidden">%paginator%</ul>'
        ));

        $this->setOptions(array(
            'navigation' => false
        ));
    }
}
