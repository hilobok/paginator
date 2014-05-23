# Paginator

[![Build Status](https://travis-ci.org/hilobok/paginator.svg?branch=master)](https://travis-ci.org/hilobok/paginator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hilobok/paginator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hilobok/paginator/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/19bda658-de91-46de-90f4-5653c1f297fd/mini.png)](https://insight.sensiolabs.com/projects/19bda658-de91-46de-90f4-5653c1f297fd)

## Installation
```json
    "require": {
        "anh/paginator": "~1.0"
    }
```

## Available adapters
- ArrayAdapter
- DoctrineOrmAdapter

## Example
```php
<?php

use Anh\Paginator\Paginator;

$data = /* ... */;

$paginator = new Paginator();
$page = $paginator->paginate($data, 1, 10);

foreach ($page->get() as $element) {
    // do something with element
}
```