<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler;

interface HandlerConfigurationInterface
{
    /**
     * @return string|null
     */
    public function getLevel(): int;

    /**
     * @return string
     */
    public static function type(): string;

    /**
     * @return string
     */
    public function getHandlerClassName(): string;

    /**
     * @return string
     */
    public function getLevelAsString(): string;
}
