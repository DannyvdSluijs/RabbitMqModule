<?php

namespace RabbitMqModule\Service;

use Zend\ServiceManager\ServiceManager;

class RpcClientFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateService()
    {
        $factory = new RpcClientFactory('foo');
        $serviceManager = new ServiceManager();
        $serviceManager->setService(
            'config',
            [
                'rabbitmq' => [
                    'rpc_client' => [
                        'foo' => [
                            'connection' => 'foo',
                            'serializer' => 'PhpSerialize',
                        ],
                    ],
                ],
            ]
        );

        $connection = $this->getMockBuilder('PhpAmqpLib\\Connection\\AbstractConnection')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $serviceManager->setService('rabbitmq.connection.foo', $connection);

        $service = $factory($serviceManager, 'service-name');

        static::assertInstanceOf('RabbitMqModule\\RpcClient', $service);
        static::assertInstanceOf('Zend\\Serializer\\Adapter\\AdapterInterface', $service->getSerializer());
    }
}
