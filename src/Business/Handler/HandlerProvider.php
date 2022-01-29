<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Monolog\Handler\HandlerInterface;

class HandlerProvider implements HandlerProviderInterface
{
    /**
     * @var iterable<string, HandlerInterface>
     */
    private iterable $handlerCollection;

    /**
     * @param HandlerFactoryInterface $handlerFactory
     */
    public function __construct(private HandlerFactoryInterface $handlerFactory)
    {
        $this->handlerCollection = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getHandler(string $handlerName): HandlerInterface
    {
        if(!array_key_exists($handlerName, $this->handlerCollection)) {
            $this->handlerCollection[$handlerName] = $this->handlerFactory->create($handlerName);
        }

        return $this->handlerCollection[$handlerName];
    }
}
