<?php

namespace Micro\Plugin\Logger\Monolog;

use Micro\Plugin\Logger\Business\Factory\LoggerFactoryInterface;
use Micro\Plugin\Logger\LoggerPlugin;
use Micro\Plugin\Logger\Monolog\Business\Factory\LoggerFactory;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactory;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactoryInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerStreamConfigurationInterface;
use Monolog\Handler\StreamHandler;

class MonologPlugin extends LoggerPlugin
{
    /**
     * {@inheritDoc}
     */
    protected function createLoggerFactory(): LoggerFactoryInterface
    {
        return new LoggerFactory($this->configuration);
    }

    /**
     * @return HandlerConfigurationFactoryInterface
     */
    protected function createHandlerConfigurationFactory(): HandlerConfigurationFactoryInterface
    {
        return new HandlerConfigurationFactory(
            $this->configuration,
            $this->getHandlerConfigurationClassCollection()
        );
    }

    /**
     * @return iterable
     */
    protected function getHandlerConfigurationClassCollection(): iterable
    {
        return [
            HandlerStreamConfigurationInterface::class
        ];
    }
}
