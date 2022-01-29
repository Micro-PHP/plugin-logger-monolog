<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

interface HandlerResolverFactoryInterface
{
    /**
     * @param string $loggerName
     *
     * @return HandlerResolverInterface
     */
    public function create(string $loggerName): HandlerResolverInterface;
}
