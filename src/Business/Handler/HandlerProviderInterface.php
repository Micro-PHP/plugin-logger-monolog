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

use Micro\Plugin\Logger\Configuration\LoggerProviderTypeConfigurationInterface;
use Monolog\Handler\HandlerInterface;

interface HandlerProviderInterface
{
    public function getHandler(LoggerProviderTypeConfigurationInterface $loggerProviderTypeConfiguration, string $handlerName): HandlerInterface;
}
