<?php

namespace spec\Anh\Paginator\Adapter;

use PhpSpec\ObjectBehavior;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;

class DoctrineOrmAdapterSpec extends ObjectBehavior
{
    public function let(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith($queryBuilder);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\Adapter\DoctrineOrmAdapter');
    }

    public function it_should_implement_AdapterInterface()
    {
        $this->shouldImplement('Anh\Paginator\AdapterInterface');
    }

    public function it_should_be_compatible_with_QueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->shouldBeCompatibleWith($queryBuilder);
    }

    public function it_should_be_compatible_with_Query(EntityManager $entityManager)
    {
        // we need to have an instance of Query as there is no way to mock final class
        // https://github.com/phpspec/prophecy/issues/102
        $query = new Query($entityManager->getWrappedObject());
        $this->shouldBeCompatibleWith($query);
    }

    public function it_should_not_be_compatible_with_other_types()
    {
        $this->shouldNotBeCompatibleWith('not compatible data');
    }
}
