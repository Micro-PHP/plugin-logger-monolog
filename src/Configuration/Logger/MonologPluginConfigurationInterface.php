<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Logger\Monolog\Configuration\Logger;

use Micro\Framework\Kernel\Configuration\ApplicationConfigurationInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerStreamConfigurationInterface;

interface MonologPluginConfigurationInterface
{
    public const HANDLER_DEFAULT = 'default';
    public const HANDLER_DEFAULT_TYPE = HandlerStreamConfigurationInterface::TYPE;
    public const LOGGER_DEFAULT = 'default';

    public function getLoggerConfiguration(string $loggerConfiguration): LoggerConfigurationInterface;

    /**
     * @return iterable<string>
     */
    public function getHandlerList(): iterable;

    public function getHandlerDefault(): string;

    public function getHandlerType(string $handlerName): ?string;

    /**
     * @return iterable<string>
     */
    public function getLoggerlist(): iterable;

    public function applicationConfiguration(): ApplicationConfigurationInterface;
}
