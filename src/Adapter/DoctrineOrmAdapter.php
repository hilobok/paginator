<?php

namespace Anh\Paginator\Adapter;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Anh\Paginator\AdapterInterface;

class DoctrineOrmAdapter implements AdapterInterface
{
    /**
     * Doctrine paginator
     * @var Paginator
     */
    protected $paginator;

    public function __construct($query, $fetchJoinCollection = true, $useOutputWalkers = false)
    {
        $this->paginator = new Paginator($query, $fetchJoinCollection);
        $this->paginator->setUseOutputWalkers($useOutputWalkers);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return $this->paginator->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getResult($offset, $limit)
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
    public static function isCompatibleWith($data)
    {
        return ($data instanceof QueryBuilder || $data instanceof Query);
    }
}
