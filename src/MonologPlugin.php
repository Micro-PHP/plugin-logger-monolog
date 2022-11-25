<?php

namespace Micro\Plugin\Logger\Monolog;

use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Logger\Business\Factory\LoggerFactoryInterface;
use Micro\Plugin\Logger\LoggerPlugin;
use Micro\Plugin\Logger\Monolog\Business\Factory\LoggerFactory;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerFactory;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerFactoryInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerProvider;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerProviderInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerResolverFactory;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerResolverFactoryInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactory;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactoryInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerAmqpConfiguration;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerStreamConfiguration;

class MonologPlugin extends LoggerPlugin
{
    /**
     * @var HandlerProviderInterface|null
     */
    private ?HandlerProviderInterface $handlerProvider = null;

    /**
     * @var Container
     */
    private Container $container;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->container = $container;

        parent::provideDependencies($container);
    }

    /**
     * {@inheritDoc}
     */
    protected function createLoggerFactory(): LoggerFactoryInterface
    {
        return new LoggerFactory(
            $this->createHandlerResolverFactory()
        );
    }

    /**
     * @return HandlerProviderInterface
     */
    protected function createHandlerProvider(): HandlerProviderInterface
    {
        if(!$this->handlerProvider) {
            $this->handlerProvider = new HandlerProvider($this->createHandlerFactory());
        }

        return $this->handlerProvider;
    }

    /**
     * @return HandlerFactoryInterface
     */
    protected function createHandlerFactory(): HandlerFactoryInterface
    {
        return new HandlerFactory(
            $this->container,
            $this->createHandlerConfigurationFactory()
        );
    }

    /**
     * @return HandlerConfigurationFactoryInterface
     */
    protected function createHandlerConfigurationFactory(): HandlerConfigurationFactoryInterface
    {
        return new HandlerConfigurationFactory(
            $this->configuration(),
            $this->getHandlerConfigurationClassCollection()
        );
    }


    protected function createHandlerResolverFactory(): HandlerResolverFactoryInterface
    {
        return new HandlerResolverFactory(
            $this->configuration(),
            $this->createHandlerProvider()
        );
    }

    /**
     * @return iterable
     */
    protected function getHandlerConfigurationClassCollection(): iterable
    {
        return [
            HandlerStreamConfiguration::class,
            HandlerAmqpConfiguration::class
        ];
    }
}
