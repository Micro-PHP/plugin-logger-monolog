<?php

namespace Micro\Plugin\Logger\Monolog;

use Micro\Plugin\Logger\LoggerPluginConfiguration;
use Micro\Plugin\Logger\Monolog\Configuration\Logger\LoggerConfiguration;
use Micro\Plugin\Logger\Monolog\Configuration\Logger\LoggerConfigurationInterface;

class MonologPluginConfiguration extends LoggerPluginConfiguration implements MonologPluginConfigurationInterface
{
    public const CFG_HANDLER_LIST = 'LOGGER_HANDLER_LIST';

    public const CFG_LOGGER_LIST = 'LOGGER_LIST';

    protected const CFG_HANDLER_TYPE = 'LOGGER_%s_TYPE';

    /**
     * {@inheritDoc}
     */
    public function getHandlerType(string $handlerName): ?string
    {
        return $this->configuration->get(sprintf(self::CFG_HANDLER_TYPE, mb_strtoupper($handlerName)));
    }

    /**
     * @return iterable<string>
     */
    public function getLoggerlist(): iterable
    {
        $loggerListSource = $this->configuration->get(self::CFG_LOGGER_LIST, self::LOGGER_DEFAULT);

        return $this->explodeStringToArray($loggerListSource);
    }

    /**
     * @param string $loggerConfiguration
     *
     * @return LoggerConfigurationInterface
     */
    public function getLoggerConfiguratrion(string $loggerConfiguration): LoggerConfigurationInterface
    {
        return new LoggerConfiguration($this->configuration, $loggerConfiguration);
    }

    /**
     * {@inheritDoc}
     */
    public function getHandlerList(): iterable
    {
        $handlerListSource = $this->configuration->get(self::CFG_HANDLER_LIST, $this->getHandlerDefault());

        return $this->explodeStringToArray($handlerListSource);
    }

    /**
     * {@inheritDoc}
     */
    public function getHandlerDefault(): string
    {
        return self::HANDLER_DEFAULT;
    }
}
