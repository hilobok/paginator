<?php

namespace spec\Anh\Paginator;

use PhpSpec\ObjectBehavior;
use Anh\Paginator\AdapterInterface;
use Anh\Paginator\Adapter\EmptyDataAdapter;

class AdapterResolverSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Anh\Paginator\AdapterResolver');
    }

    public function it_should_leave_adapter_untouched(AdapterInterface $adapter)
    {
        $this->resolve($adapter)->shouldReturn($adapter);
    }

    public function it_should_return_adapter_for_known_data()
    {
        $this->resolve(array())->shouldImplement('Anh\Paginator\AdapterInterface');
    }

    public function it_should_return_null_for_unknown_data()
    {
        $this->resolve('there is no adapter for string')->shouldReturn(null);
    }

    public function it_should_add_adapter_object(AdapterInterface $adapter)
    {
        $count = count($this->getWrappedObject()->getAdapters());
        $this->addAdapter($adapter);
        $this->getAdapters()->shouldHaveCount($count + 1);
    }

    public function it_should_add_adapter_class(AdapterInterface $adapter)
    {
        $count = count($this->getWrappedObject()->getAdapters());
        $this->addAdapter(get_class($adapter->getWrappedObject()));
        $this->getAdapters()->shouldHaveCount($count + 1);
    }

    public function it_should_ignore_already_added_adapter(AdapterInterface $adapter)
    {
        $count = count($this->getWrappedObject()->getAdapters());
        $this->addAdapter($adapter);
        $this->addAdapter($adapter);
        $this->getAdapters()->shouldHaveCount($count + 1);
    }

    public function it_should_throw_exception_when_adding_adapter_which_not_implements_AdapterInterface()
    {
        $this->shouldThrow('InvalidArgumentException')
            ->during('addAdapter', array(new \StdClass))
        ;
    }

    public function it_should_remove_adapter_object()
    {
        $count = count($this->getWrappedObject()->getAdapters());
        $this->removeAdapter(new EmptyDataAdapter());
        $this->getAdapters()->shouldHaveCount($count - 1);
    }

    public function it_should_remove_adapter_class()
    {
        $count = count($this->getWrappedObject()->getAdapters());
        $this->removeAdapter('Anh\Paginator\Adapter\ArrayAdapter');
        $this->getAdapters()->shouldHaveCount($count - 1);
    }

    public function it_should_replace_adapter(AdapterInterface $new)
    {
        $count = count($this->getWrappedObject()->getAdapters());
        $old = 'Anh\Paginator\Adapter\ArrayAdapter';
        $this->replaceAdapter($old, $new);
        $this->getAdapters()->shouldHaveCount($count);
        $this->getAdapters()->shouldNotHaveValue($old);
    }

    public function getMatchers()
    {
        return array(
            'haveValue' => function ($subject, $value) {
                return in_array($value, $subject);
            },
        );
    }
}
