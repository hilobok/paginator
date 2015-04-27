<?php

namespace spec\Anh\Paginator\Adapter;

use PhpSpec\ObjectBehavior;
use Doctrine\ORM\QueryBuilder;

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

    public function it_should_be_compatible_with_Query()
    {
        // we need to have an instance of Query as there is no way to mock final class
        // also it's not right to mock doctrine in order to test it's behaviour
        // https://github.com/phpspec/prophecy/issues/102
        return;
    }

    public function it_should_not_be_compatible_with_other_types()
    {
        $this->shouldNotBeCompatibleWith('not compatible data');
    }
}
