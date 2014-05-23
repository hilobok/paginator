<?php

namespace Anh\Paginator;

class AdapterGuesser
{
    const ADAPTER_INTERFACE = 'Anh\Paginator\AdapterInterface';

    /**
     * List of classes of all available adapters
     * @var array
     */
    protected $adapters = array(
        'Anh\Paginator\Adapter\ArrayAdapter',
        'Anh\Paginator\Adapter\DoctrineOrmAdapter'
    );

    /**
     * Add adapter, it should implement AdapterInterface
     * @param AdapterInterface|string $adapter Adapter to add
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
     * Remove adapter
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
     * Replace adapter
     * @param AdapterInterface|string $old Old adapter
     * @param AdapterInterface|string $new New adapter
     */
    public function replaceAdapter($old, $new)
    {
        $this->removeAdapter($old);
        $this->addAdapter($new);
    }

    /**
     * Get adapters
     * @return array Array of classes of all available adapters
     */
    public function getAdapters()
    {
        return $this->adapters;
    }

    /**
     * Guess adapter for given data
     * @param  mixed                 $data
     * @return AdapterInterface|null
     */
    public function guess($data)
    {
        if ($data instanceof AdapterInterface) {
            return $data;
        }

        foreach ($this->adapters as $adapter) {
            if ($this->isAdapterCompatible($adapter, $data)) {
                return new $adapter($data);
            }
        }

        return null;
    }

    protected function getAdapterClass($adapter)
    {
        if (is_object($adapter)) {
            $adapter = get_class($adapter);
        }

        return $adapter;
    }

    protected function isAdapterCompatible($adapter, $data)
    {
        return call_user_func_array(
            sprintf('%s::%s', $adapter, 'isCompatibleWith'),
            array($data)
        );
    }
}
