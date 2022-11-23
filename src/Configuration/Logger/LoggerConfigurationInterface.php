<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Logger;

interface LoggerConfigurationInterface
{
    /**
     * @return iterable<string>
     */
    public function getHandlerList(): iterable;

    /**
     * @return string
     */
    public function getName(): string;
}
