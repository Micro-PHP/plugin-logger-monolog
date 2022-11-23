<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Micro\Plugin\Logger\Monolog\MonologPluginConfigurationInterface;

class HandlerResolverFactory implements HandlerResolverFactoryInterface
{
    /**
     * @param MonologPluginConfigurationInterface $pluginConfiguration
     * @param HandlerProviderInterface $handlerProvider
     */
    public function __construct(
    private MonologPluginConfigurationInterface $pluginConfiguration,
    private HandlerProviderInterface $handlerProvider
    )
    {
    }

    /**
     * @param string $loggerName
     * @return HandlerResolverInterface
     */
    public function create(string $loggerName): HandlerResolverInterface
    {
        return new HandlerResolver(
            $this->pluginConfiguration,
            $this->handlerProvider,
            $loggerName
        );
    }
}
