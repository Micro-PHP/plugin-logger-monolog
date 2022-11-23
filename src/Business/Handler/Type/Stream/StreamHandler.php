<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler\Type\Stream;

use Micro\Plugin\Logger\Monolog\Business\Handler\Type\AbstractHandler;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerStreamConfigurationInterface;
use Monolog\Handler\StreamHandler as MonologStreamHandler;

class StreamHandler extends AbstractHandler
{
    private MonologStreamHandler $handler;

    /**
     * @return void
     */
    public function configure(): void
    {
        /** @var HandlerStreamConfigurationInterface $configuration */
        $configuration = $this->handlerConfiguration;

        $this->handler = new MonologStreamHandler(
            $configuration->getLogFile(),
            $configuration->getLevel(),
            true,
            null,
            $configuration->useLocking(),
        );
    }

    /**
     * @param array $record
     *
     * @return void
     */
    protected function write(array $record): void
    {
        $this->handler->write($record);
    }
}
