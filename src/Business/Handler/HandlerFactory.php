<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactoryInterface;
use Monolog\Handler\HandlerInterface;

class HandlerFactory implements HandlerFactoryInterface
{
    /**
     * @param HandlerConfigurationFactoryInterface $handlerConfigurationFactory
     */
    public function __construct(private HandlerConfigurationFactoryInterface $handlerConfigurationFactory)
    {
    }

    /**
     * @param string $handlerName
     * @return HandlerInterface
     */
    public function create(string $handlerName): HandlerInterface
    {
        $handlerConfiguration = $this->handlerConfigurationFactory->create($handlerName);
        $handlerClassName = $handlerConfiguration->getHandlerClassName();

        return new $handlerClassName(...$handlerConfiguration->getHandlerConstructorArguments());
    }
}
