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
     * @return array<string, mixed>
     */
    public function getHandlerConstructorArguments(): array;

    /**
     * @return string
     */
    public function getHandlerClassName(): string;
}
