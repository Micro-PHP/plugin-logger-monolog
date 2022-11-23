<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Micro\Plugin\Logger\Monolog\MonologPluginConfigurationInterface;

class HandlerResolver implements HandlerResolverInterface
{
    /**
     * @param MonologPluginConfigurationInterface $pluginConfiguration
     * @param HandlerProviderInterface $handlerProvider
     * @param string $loggerName
     */
    public function __construct(
        private readonly MonologPluginConfigurationInterface $pluginConfiguration,
        private readonly HandlerProviderInterface            $handlerProvider,
        private readonly string $loggerName
    )
    {
    }

    /**
     * @return iterable
     */
    public function resolve(): iterable
    {
        $loggerConfiguration = $this->pluginConfiguration->getLoggerConfiguratrion($this->loggerName);

        foreach ($loggerConfiguration->getHandlerList() as $handlerName) {
            yield $this->handlerProvider->getHandler($handlerName);
        }
    }
}
