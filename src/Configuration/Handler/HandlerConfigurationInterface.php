<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler;

use Micro\Plugin\Logger\Monolog\Business\Handler\HandlerInterface;

interface HandlerConfigurationInterface
{
    public static function type(): string;

    /**
     * @return class-string<HandlerInterface>
     */
    public function getHandlerClassName(): string;
}
