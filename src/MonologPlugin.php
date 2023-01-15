<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Logger\Monolog;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
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
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerStreamConfiguration;
use Micro\Plugin\Logger\Monolog\Configuration\Logger\MonologPluginConfigurationInterface;
use Micro\Plugin\Logger\Plugin\LoggerProviderPluginInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * @method MonologPluginConfigurationInterface configuration()
 */
class MonologPlugin implements DependencyProviderInterface, PluginDependedInterface, LoggerProviderPluginInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

    private ?HandlerProviderInterface $handlerProvider = null;

    private Container $container;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->container = $container;
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

    protected function createHandlerProvider(): HandlerProviderInterface
    {
        if (!$this->handlerProvider) {
            $this->handlerProvider = new HandlerProvider($this->createHandlerFactory());
        }

        return $this->handlerProvider;
    }

    protected function createHandlerFactory(): HandlerFactoryInterface
    {
        return new HandlerFactory(
            $this->container,
            $this->createHandlerConfigurationFactory()
        );
    }

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
     * @return iterable<class-string<HandlerConfigurationInterface>>
     */
    protected function getHandlerConfigurationClassCollection(): iterable
    {
        return [
            HandlerStreamConfiguration::class,
        ];
    }

    public function getLoggerFactory(): LoggerFactoryInterface
    {
        return $this->createLoggerFactory();
    }

    public function getLoggerAdapterName(): string
    {
        return 'monolog';
    }

    public function getDependedPlugins(): iterable
    {
        return [
            LoggerPlugin::class,
        ];
    }
}
