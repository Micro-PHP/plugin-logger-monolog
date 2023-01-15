<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Logger\Monolog\Test\Unit\Business\Handler;

use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerFactory;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactoryInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationInterface;
use PHPUnit\Framework\TestCase;

class HandlerFactoryTest extends TestCase
{
    public function testCreate()
    {
        $handlerConfig = $this->createMock(HandlerConfigurationInterface::class);
        $handlerConfig
            ->expects($this->once())
            ->method('getHandlerClassName')
            ->willReturn(TestHandlerImpl::class);

        $container = $this->createMock(Container::class);
        $handlerConfigurationFactory = $this->createMock(HandlerConfigurationFactoryInterface::class);
        $handlerConfigurationFactory->expects($this->once())
            ->method('create')
            ->willReturn($handlerConfig);

        $handlerFactory = new HandlerFactory($container, $handlerConfigurationFactory);
        $handler = $handlerFactory->create('test');

        $this->assertInstanceOf(TestHandlerImpl::class, $handler);
    }
}
