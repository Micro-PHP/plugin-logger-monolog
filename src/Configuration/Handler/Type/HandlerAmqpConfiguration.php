<?php

namespace Micro\Plugin\Logger\Monolog\Configuration\Handler\Type;

use Micro\Plugin\Logger\Monolog\Business\Handler\Type\Amqp\AmqpHandler;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\HandlerConfiguration;

class HandlerAmqpConfiguration extends HandlerConfiguration implements HandlerAmqpConfigurationInterface
{
    protected const CFG_PUBLISHER_NAME = 'LOGGER_%s_PUBLISHER';

    /**
     * @return string
     */
    public function getPublisherName(): string
    {
        $publisher = $this->get(self::CFG_PUBLISHER_NAME, null, false);

        return $publisher;
    }

    public static function type(): string
    {
        return 'amqp';
    }

    /**
     * @return string
     */
    public function getHandlerClassName(): string
    {
        return AmqpHandler::class;
    }
}
