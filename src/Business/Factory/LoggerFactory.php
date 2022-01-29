<?php

namespace Micro\Plugin\Logger\Monolog\Business\Factory;

use Micro\Plugin\Logger\Business\Factory\LoggerFactoryInterface;
use Micro\Plugin\Logger\LoggerPluginConfiguration;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerFactory implements LoggerFactoryInterface
{
    public function __construct(private LoggerPluginConfiguration $configuration)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $loggerName): LoggerInterface
    {
        $logger = new Logger($this->configuration->getLoggerDefaultName());

        $logger->pushHandler($this->createHandler());

        return $logger;
    }

    /**
     * @return AbstractProcessingHandler
     */
    protected function createHandler(): AbstractProcessingHandler
    {
        return new StreamHandler(
            $this->configuration->getLogFile(),
            $this->configuration->getLogLevel()
        );
    }
}
