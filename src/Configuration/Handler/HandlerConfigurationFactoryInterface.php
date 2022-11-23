<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler;

interface HandlerConfigurationFactoryInterface
{
    /**
     * @param string $handlerName
     *
     * @return HandlerConfigurationInterface
     */
    public function create(string $handlerName): HandlerConfigurationInterface;
}
