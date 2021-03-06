<?php

declare(strict_types=1);

namespace RabbitMqModule\Service\Connection;

use PhpAmqpLib\Connection\AbstractConnection;
use RabbitMqModule\Options\Connection as ConnectionOptions;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class StreamConnectionFactory.
 */
class StreamConnectionFactory implements ConnectionFactoryInterface
{
    /**
     * @codeCoverageIgnore
     *
     * @param ConnectionOptions $options
     *
     * @return AMQPStreamConnection
     */
    public function createConnection(ConnectionOptions $options): AbstractConnection
    {
        return new AMQPStreamConnection(
            $options->getHost(),
            $options->getPort(),
            $options->getUsername(),
            $options->getPassword(),
            $options->getVhost(),
            $options->isInsist(),
            $options->getLoginMethod(),
            null,
            $options->getLocale(),
            $options->getConnectionTimeout(),
            $options->getReadWriteTimeout(),
            null,
            $options->isKeepAlive(),
            $options->getHeartbeat()
        );
    }
}
