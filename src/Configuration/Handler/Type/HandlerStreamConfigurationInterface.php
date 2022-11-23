<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler\Type;

use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationInterface;

interface HandlerStreamConfigurationInterface extends HandlerConfigurationInterface
{
    public const TYPE = 'stream';

    /**
     * @return string
     */
    public function getLogFile(): string;

    /**
     * @return bool
     */
    public function useLocking(): bool;
}
