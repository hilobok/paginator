# Paginator

[![Build Status](https://travis-ci.org/hilobok/paginator.svg?branch=master)](https://travis-ci.org/hilobok/paginator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hilobok/paginator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hilobok/paginator/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/19bda658-de91-46de-90f4-5653c1f297fd/mini.png)](https://insight.sensiolabs.com/projects/19bda658-de91-46de-90f4-5653c1f297fd)

## Installation
```bash
$ php composer.phar require 'anh/paginator:0.1.0'
```

## Usage
Create paginator and call it's `paginate()` method with data, page number and number of elements per page. It will find appropriate adapter and return `Page` instance, filled with paginated data, it can be used in `foreach` directly. Also you can pass manually created adapter instead of data.
```php
<?php

use Anh\Paginator\Paginator;

$query = /* ORM Query or QueryBuilder for fetching users */;

$paginator = new Paginator();
$users = $paginator->paginate($query, 1, 10);

foreach ($users as $user) {
    // do something with user
}
```

If you need to pass options to adapter, pass it to `paginate()` as fourth parameter. Note each adapter has own options.
```php
<?php

use Anh\Paginator\Paginator;
use Anh\Paginator\Adapter\ArrayAdapter;

$data = array(/* elements */);

$paginator = new Paginator();
$elements = $paginator->paginate($data, 3, 20, array('preserveKeys' => true));

foreach ($elements as $key => $element) {
    // do something with element
}
```

You can create custom adapters and add them to `AdapterResolver`. All adapters must implement `AdapterInterface` interface.
```php
<?php

use Anh\Paginator\Paginator;
use Anh\Paginator\AdapterResolver;

$adapterResolver = new AdapterResolver();
$adapterResolver->addAdapter('Some\Custom\Adapter1');
$adapterResolver->addAdapter('Some\Custom\Adapter2');

$paginator = new Paginator($adapterResolver);
$elements = $paginator->paginate($data, $pageNumber, $elementsPerPage);

foreach ($elements as $element) {
    // do something with element
}
```

## Available adapters
- EmptyDataAdapter
- ArrayAdapter
- DoctrineOrmAdapter

## Versioning
Library uses [semantic versioning](http://semver.org/).

## License
MIT
