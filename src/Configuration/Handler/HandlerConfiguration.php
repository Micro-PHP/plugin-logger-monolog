<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;
use Monolog\Logger;

abstract class HandlerConfiguration extends PluginRoutingKeyConfiguration implements HandlerConfigurationInterface
{
    protected const CFG_LEVEL = 'LOGGER_%s_LEVEL';

    public const LEVEL_DEFAULT = 'DEBUG';

    /**
     * {@inheritDoc}
     */
    public function getLevel(): int
    {
        $level = mb_strtoupper($this->getLevelAsString());

        return constant(Logger::class . "::$level");
    }

    /**
     * {@inheritDoc}
     */
    public function getLevelAsString(): string
    {
        return mb_strtolower($this->get(self::CFG_LEVEL, self::LEVEL_DEFAULT));
    }
}
