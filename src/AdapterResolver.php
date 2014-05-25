<?php

namespace Anh\Paginator;

class AdapterResolver
{
    const ADAPTER_INTERFACE = 'Anh\Paginator\AdapterInterface';

    /**
     * List of classes of all available adapters.
     * @var array
     */
    protected $adapters = array(
        'Anh\Paginator\Adapter\EmptyDataAdapter',
        'Anh\Paginator\Adapter\ArrayAdapter',
        'Anh\Paginator\Adapter\DoctrineOrmAdapter'
    );

    /**
     * Add adapter (object or class), it should implement AdapterInterface.
     * @param AdapterInterface|string $adapter Adapter to add.
     */
    public function addAdapter($adapter)
    {
        $adapter = $this->getAdapterClass($adapter);

        if (!is_subclass_of($adapter, self::ADAPTER_INTERFACE)) {
            throw new \InvalidArgumentException(
                sprintf("Adapter '%s' should implement '%s' interface", $adapter, self::ADAPTER_INTERFACE)
            );
        }

        if (!in_array($adapter, $this->adapters, true)) {
            $this->adapters[] = $adapter;
        }
    }

    /**
     * Removes given adapter (object or class).
     * @param AdapterInterface|string $adapter Adapter to remove
     */
    public function removeAdapter($adapter)
    {
        $adapter = $this->getAdapterClass($adapter);

        $this->adapters = array_merge( // reorder keys
            array_diff($this->adapters, array($adapter))
        );
    }

    /**
     * Replaces adapter with new one (object or class).
     * @param AdapterInterface|string $old Old adapter.
     * @param AdapterInterface|string $new New adapter.
     */
    public function replaceAdapter($old, $new)
    {
        $this->removeAdapter($old);
        $this->addAdapter($new);
    }

    /**
     * Returns list of classes of available adapters.
     * @return array Array of classes of all available adapters
     */
    public function getAdapters()
    {
        return $this->adapters;
    }

    /**
     * Resolves adapter for given dataset. Returns null if no adapter found.
     * @param  mixed                 $data Dataset for pagination.
     * @return AdapterInterface|null
     */
    public function resolve($data, array $options = array())
    {
        if ($data instanceof AdapterInterface) {
            return $data;
        }

        foreach ($this->adapters as $adapter) {
            if ($this->isAdapterCompatible($adapter, $data)) {
                return new $adapter($data, $options);
            }
        }

        return null;
    }

    /**
     * Returns class of given adapter.
     * @param  mixed $adapter
     * @return string
     */
    protected function getAdapterClass($adapter)
    {
        if (is_object($adapter)) {
            $adapter = get_class($adapter);
        }

        return $adapter;
    }

    /**
     * Returns whether adapter supports given dataset.
     * @param  string  $adapter Adapter class.
     * @param  mixed  $data    Data for pagination.
     * @return boolean
     */
    protected function isAdapterCompatible($adapter, $data)
    {
        return call_user_func_array(
            sprintf('%s::%s', $adapter, 'isCompatibleWith'),
            array($data)
        );
    }
}
