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

use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerFactoryInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerProvider;
use Monolog\Handler\HandlerInterface;
use PHPUnit\Framework\TestCase;

class HandlerProviderTest extends TestCase
{
    public function testGetHandler()
    {
        $handlerFactory = $this->createMock(HandlerFactoryInterface::class);
        $handlerFactory->expects($this->once())
            ->method('create')
            ->willReturn(new TestHandlerImpl());

        $provider = new HandlerProvider($handlerFactory);
        $handler = $provider->getHandler('test');

        $this->assertSame($handler, $provider->getHandler('test'));
        $this->assertInstanceOf(HandlerInterface::class, $handler);
    }
}
