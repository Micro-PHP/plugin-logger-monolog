<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler\Type;

use Micro\Plugin\Logger\Monolog\Business\Handler\Type\Stream\StreamHandler;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfiguration;

class HandlerStreamConfiguration extends HandlerConfiguration implements HandlerStreamConfigurationInterface
{
    protected const CFG_LOG_FILE    = 'LOGGER_%s_FILE';
    protected const CFG_USE_LOCKING = 'LOGGER_%s_USE_LOCKING';

    /**
     * {@inheritDoc}
     */
    public function getLogFile(): string
    {
        $logFile = $this->get(self::CFG_LOG_FILE, $this->configuration->get('BASE_PATH') . '/var/log/micro/', false);

        if(is_dir($logFile)) {
            return $this->getFilename($logFile);
        }

        return $this->getFilename($logFile);
    }

    /**
     * {@inheritDoc}
     */
    public function useLocking(): bool
    {
        return $this->get(self::CFG_USE_LOCKING, false);
    }

    /**
     * @TODO: Templates supports
     *
     * @param string $logFileConfigValue
     * @return string
     */
    protected function getFilename(string $logFileConfigValue): string
    {
        $adapterLevel = $this->getLevelAsString();

        return rtrim($logFileConfigValue, '/') .
            DIRECTORY_SEPARATOR .
            $this->configRoutingKey . '-' .
            $adapterLevel . '-' .
            (new \DateTime('now'))->format('Y-m-d') .
            '.log';
    }

    /**
     * @return string
     */
    public static function type(): string
    {
        return self::TYPE;
    }

    /**
     * @return string
     */
    public function getHandlerClassName(): string
    {
        return StreamHandler::class;
    }
}
