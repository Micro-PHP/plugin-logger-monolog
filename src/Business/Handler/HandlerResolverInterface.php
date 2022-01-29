<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Monolog\Handler\HandlerInterface;

interface HandlerResolverInterface
{
    /**
     * @return HandlerInterface[]
     */
    public function resolve(): iterable;
}
