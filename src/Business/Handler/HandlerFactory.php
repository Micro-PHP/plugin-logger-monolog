<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactoryInterface;
use Monolog\Handler\HandlerInterface;

class HandlerFactory implements HandlerFactoryInterface
{
    /**
     * @param HandlerConfigurationFactoryInterface $handlerConfigurationFactory
     */
    public function __construct(
        private Container $container,
        private HandlerConfigurationFactoryInterface $handlerConfigurationFactory
    )
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

        return new $handlerClassName(
            $this->container,
            $handlerConfiguration
        );
    }
}
