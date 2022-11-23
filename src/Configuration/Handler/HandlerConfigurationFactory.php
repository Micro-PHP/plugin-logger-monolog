<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler;

use Micro\Plugin\Logger\Monolog\MonologPluginConfigurationInterface;

class HandlerConfigurationFactory implements HandlerConfigurationFactoryInterface
{
    /**
     * @param MonologPluginConfigurationInterface $pluginConfiguration
     * @param iterable $handlerConfigurationClassCollection
     */
    public function __construct(
        private readonly MonologPluginConfigurationInterface $pluginConfiguration,
        private readonly iterable $handlerConfigurationClassCollection
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $handlerName): HandlerConfigurationInterface
    {
        $handlerType = $this->pluginConfiguration->getHandlerType($handlerName);

        foreach ($this->handlerConfigurationClassCollection as $handlerConfigurationClass) {
            if($handlerConfigurationClass::type() !== $handlerType) {
                continue;
            }

            $handlerClass =  new $handlerConfigurationClass($this->pluginConfiguration->applicationConfiguration(), $handlerName);
            if(!in_array(HandlerConfigurationInterface::class, class_implements($handlerClass), true)) {
                $this->throwHandlerCreateException($handlerName, sprintf('Class "%s" should be implements "%s".',
                    $handlerClass, HandlerConfigurationInterface::class
                ));
            }

            return $handlerClass;
        }

        throw new \RuntimeException(sprintf('Can not resolve configuration class for handler "%s"', $handlerName));
    }

    /**
     * @param string $handlerName
     * @param string $message
     * @return void
     */
    protected function throwHandlerCreateException(string $handlerName, string $message): void
    {
        throw new \RuntimeException(sprintf('Logger handler "%s" create error: %s', $handlerName, $message));
    }
}
