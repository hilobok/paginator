# Paginator

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