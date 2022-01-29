<?php

namespace Micro\Plugin\Logger\Monolog\Business\Handler\Type\Amqp;


use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\Business\Message\Message;
use Micro\Plugin\Amqp\Business\Message\MessageInterface;
use Micro\Plugin\Logger\Monolog\Business\Handler\Type\AbstractHandler;
use Micro\Plugin\Logger\Monolog\Configuration\Handler\Type\HandlerAmqpConfigurationInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class AmqpHandler extends AbstractHandler
{
    /**
     * {@inheritDoc}
     */
    public function configure(): void
    {
        parent::configure();

        if(!interface_exists(AmqpFacadeInterface::class)) {
            $this->throwPluginException(AmqpFacadeInterface::class, 'micro/plugin-amqp');
        }

        if(!interface_exists(UuidFacadeInterface::class)) {
            $this->throwPluginException(UuidFacadeInterface::class, 'micro/plugin-uuid');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record): void
    {
        $data = $record['formatted'];
        /** @var HandlerAmqpConfigurationInterface $configuration */
        $configuration = $this->handlerConfiguration;
        $message = $this->createMessage($data);

        $this->getAmqpFacade()->publish($message, $configuration->getPublisherName());
    }

    /**
     * @return AmqpFacadeInterface
     */
    protected function getAmqpFacade(): AmqpFacadeInterface
    {
        return $this->container->get(AmqpFacadeInterface::class);
    }

    /**
     * @return UuidFacadeInterface
     */
    protected function getUuidFacade(): UuidFacadeInterface
    {
        return $this->container->get(UuidFacadeInterface::class);
    }

    /**
     * @param string $message
     * @return MessageInterface
     */
    protected function createMessage(string $message): MessageInterface
    {
        return new Message(
            $this->getUuidFacade()->v4(),
            $message
        );
    }

    /**
     * @param string $className
     * @param string $composerName
     * @return void
     */
    protected function throwPluginException(string $className, string $composerName): void
    {
        throw new \RuntimeException(sprintf(
            'Class"%s" not found. Please, install plugin "composer require %s".',
            $className,
            $composerName
        ));
    }
}
