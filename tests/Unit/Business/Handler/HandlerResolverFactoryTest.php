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

use Micro\Plugin\Logger\Configuration\LoggerProviderTypeConfigurationInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerProviderInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerResolverFactory;
use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerResolverInterface;
use Micro\Plugin\Logger\Monolog\Configuration\Logger\MonologPluginConfigurationInterface;
use PHPUnit\Framework\TestCase;

class HandlerResolverFactoryTest extends TestCase
{
    public function testCreate()
    {
        $loggerProviderTypeConfiguration = $this->createMock(LoggerProviderTypeConfigurationInterface::class);
        $pluginConfiguration = $this->createMock(MonologPluginConfigurationInterface::class);
        $handlerProvider = $this->createMock(HandlerProviderInterface::class);

        $factory = new HandlerResolverFactory($pluginConfiguration, $handlerProvider);
        $resolver = $factory->create($loggerProviderTypeConfiguration);

        $this->assertInstanceOf(HandlerResolverInterface::class, $resolver);
    }
}
