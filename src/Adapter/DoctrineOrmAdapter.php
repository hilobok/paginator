<?php

namespace Anh\Paginator\Adapter;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Anh\Paginator\AdapterInterface;

class DoctrineOrmAdapter implements AdapterInterface
{
    /**
     * Doctrine paginator.
     * @var Paginator
     */
    protected $paginator;

    /**
     * Constructor
     * @param mixed $query   QueryBuilder or Query instance.
     * @param array  $options Adapter options.
     */
    public function __construct($query, array $options = array())
    {
        $options += array(
            'fetchJoinCollection' => true,
            'useOutputWalkers' => false
        );

        $this->paginator = new Paginator($query, $options['fetchJoinCollection']);
        $this->paginator->setUseOutputWalkers($options['useOutputWalkers']);
    }

    /**
     * {@inheritdoc}
     */
    public function createIterator($offset, $limit)
    {
        $this->paginator->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($limit)
        ;

        return $this->paginator->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCount()
    {
        return count($this->paginator);
    }

    /**
     * {@inheritdoc}
     */
    public static function isCompatibleWith($data)
    {
        return ($data instanceof QueryBuilder || $data instanceof Query);
    }
}
