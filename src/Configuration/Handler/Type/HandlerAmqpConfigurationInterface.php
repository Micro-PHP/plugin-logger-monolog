<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler\Type;

use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfigurationInterface;

interface HandlerAmqpConfigurationInterface extends HandlerConfigurationInterface
{
    /**
     * @return string
     */
    public function getPublisherName(): string;
}
