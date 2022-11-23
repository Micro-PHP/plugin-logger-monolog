<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Monolog\Handler\HandlerInterface;
use Psr\Log\LoggerInterface;

interface HandlerProviderInterface
{
    /**
     * @param string $handlerName
     *
     * @return HandlerInterface
     */
    public function getHandler(string $handlerName): HandlerInterface;
}
