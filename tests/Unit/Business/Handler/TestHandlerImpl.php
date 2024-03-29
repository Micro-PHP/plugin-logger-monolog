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

use Monolog\LogRecord;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class TestHandlerImpl implements \Monolog\Handler\HandlerInterface
{
    public function isHandling(LogRecord $record): bool
    {
    }

    public function handle(LogRecord $record): bool
    {
    }

    public function handleBatch(array $records): void
    {
    }

    public function close(): void
    {
    }
}
