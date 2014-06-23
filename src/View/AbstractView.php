<?php

namespace Anh\Paginator\View;

use Anh\Paginator\ViewInterface;
use Anh\Paginator\PageInterface;
use Anh\Paginator\UrlGenerator;

abstract class AbstractView implements ViewInterface
{
    protected $urlGenerator;

    protected $templates;

    protected $options;

    public function __construct($urlGenerator = null)
    {
        $this->urlGenerator = $urlGenerator ?: new UrlGenerator();
    }

    /**
     * {@inheritdoc}
     */
    abstract public function render(PageInterface $page, $url, array $options = array());

    public function setTemplates(array $templates)
    {
        $this->templates = $templates + $this->templates;

        return $this;
    }

    public function setOptions(array $options)
    {
        $this->options = $options + $this->options;

        return $this;
    }
}
