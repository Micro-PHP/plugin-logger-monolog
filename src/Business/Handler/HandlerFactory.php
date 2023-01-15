<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Logger\Monolog\Business\Handler;

use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationFactoryInterface;
use Monolog\Handler\HandlerInterface;

readonly class HandlerFactory implements HandlerFactoryInterface
{
    public function __construct(
        private Container $container,
        private HandlerConfigurationFactoryInterface $handlerConfigurationFactory
    ) {
    }

    public function create(string $handlerName): HandlerInterface
    {
        $handlerConfiguration = $this->handlerConfigurationFactory->create($handlerName);
        $handlerClassName = $handlerConfiguration->getHandlerClassName();

        return new $handlerClassName(
            $this->container,
            $handlerConfiguration
        );
    }
}
