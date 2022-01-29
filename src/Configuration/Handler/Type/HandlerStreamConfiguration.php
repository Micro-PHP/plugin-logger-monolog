<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler\Type;

use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfiguration;
use Monolog\Handler\StreamHandler;

class HandlerStreamConfiguration extends HandlerConfiguration implements HandlerStreamConfigurationInterface
{
    protected const CFG_LOG_FILE = 'LOGGER_%s_FILE';
    protected const CFG_USE_LOCKING = 'LOGGER_%s_USE_LOCKING';

    public const LOGFILE_DEFAULT_PATH = '/var/log/micro/';

    /**
     * {@inheritDoc}
     */
    public function getLogFile(): string
    {
        $logFile = $this->get(self::CFG_LOG_FILE, self::LOGFILE_DEFAULT_PATH);
        if($logFile === null) {
            $this->throwFileException('Value can not be null');
        }

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
     * @param string $message
     * @return void
     */
    protected function throwFileException(string $message): void
    {
        throw new \RuntimeException(sprintf(
            'Logger configuration failed: Configuration "%s": %s.',
                $this->cfg(self::CFG_LOG_FILE),
                $message
            )
        );
    }

    /**
     * @return string
     */
    public static function type(): string
    {
        return 'stream';
    }

    /**
     * {@inheritDoc}
     */
    public function getHandlerConstructorArguments(): array
    {
        return [
            $this->getLogFile(),
            $this->getLevel(),
            true,
            null,
            $this->useLocking(),
        ];
    }

    /**
     * @return string
     */
    public function getHandlerClassName(): string
    {
        return StreamHandler::class;
    }
}
