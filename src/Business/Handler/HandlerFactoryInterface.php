<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Monolog\Handler\HandlerInterface;

interface HandlerFactoryInterface
{
    /**
     * @param string $handlerName
     *
     * @return HandlerInterface
     */
    public function create(string $handlerName): HandlerInterface;
}
