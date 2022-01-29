<?php

namespace Micro\Plugin\Logger\Monolog;

use Micro\Plugin\Logger\LoggerPluginConfigurationInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Logger\LoggerConfigurationInterface;

interface MonologPluginConfigurationInterface extends LoggerPluginConfigurationInterface
{
    public const HANDLER_DEFAULT = 'default';
    public const LOGGER_DEFAULT = 'default';


    /**
     * @param string $loggerConfiguration
     *
     * @return LoggerConfigurationInterface
     */
    public function getLoggerConfiguratrion(string $loggerConfiguration): LoggerConfigurationInterface;

    /**
     * @return iterable<string>
     */
    public function getHandlerList(): iterable;

    /**
     * @return string
     */
    public function getHandlerDefault(): string;

    /**
     * @param string $handlerName
     *
     * @return string|null
     */
    public function getHandlerType(string $handlerName): ?string;

    /**
     * @return iterable<string>
     */
    public function getLoggerlist(): iterable;
}
