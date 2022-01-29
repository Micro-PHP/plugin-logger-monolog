<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Logger;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;
use Micro\Plugin\Logger\Monolog\MonologPluginConfigurationInterface;

class LoggerConfiguration extends PluginRoutingKeyConfiguration implements LoggerConfigurationInterface
{
    public const CFG_HANDLER_LIST = 'LOGGER_%s_HANDLERS';

    /**
     * {@inheritDoc}
     */
    public function getHandlerList(): iterable
    {
        $handlerListSource = $this->get(self::CFG_HANDLER_LIST, MonologPluginConfigurationInterface::HANDLER_DEFAULT);

        return $this->explodeStringToArray($handlerListSource);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->configRoutingKey;
    }
}
