<?php

namespace Micro\Plugin\Logger\Monolog\Business\Factory;

use Micro\Plugin\Logger\Business\Factory\LoggerFactoryInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerResolverFactoryInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerFactory implements LoggerFactoryInterface
{
    /**
     * @param HandlerResolverFactoryInterface $handlerResolverFactory
     */
    public function __construct(
        private HandlerResolverFactoryInterface $handlerResolverFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $loggerName): LoggerInterface
    {
        $logger = new Logger($loggerName);
        $handlerCollection = $this->handlerResolverFactory
            ->create($loggerName)
            ->resolve();

        $logger->setHandlers(iterator_to_array($handlerCollection));

        return $logger;
    }
}
