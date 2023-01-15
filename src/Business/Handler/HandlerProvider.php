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

use Monolog\Handler\HandlerInterface;

class HandlerProvider implements HandlerProviderInterface
{
    /**
     * @var array<string, HandlerInterface>
     */
    private array $handlerCollection;

    public function __construct(private HandlerFactoryInterface $handlerFactory)
    {
        $this->handlerCollection = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getHandler(string $handlerName): HandlerInterface
    {
        if (!\array_key_exists($handlerName, $this->handlerCollection)) {
            $this->handlerCollection[$handlerName] = $this->handlerFactory->create($handlerName);
        }

        return $this->handlerCollection[$handlerName];
    }
}
