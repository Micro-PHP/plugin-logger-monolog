<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler\Type;

use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationInterface;
use Monolog\Handler\AbstractProcessingHandler;

abstract class AbstractHandler extends AbstractProcessingHandler implements HandlerInterface
{
    /**
     * @param Container $container
     *
     * @param HandlerConfigurationInterface $handlerConfiguration
     */
    public function __construct(protected Container $container, protected HandlerConfigurationInterface $handlerConfiguration)
    {
        parent::__construct($handlerConfiguration->getLevel());

        $this->configure();
    }

    /**
     * @return void
     */
    public function configure(): void
    {
    }
}
