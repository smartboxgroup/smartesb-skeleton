<?php

declare(strict_types=1);

namespace SmartboxSkeletonRemoteDemoBundle\Tests\Controller;

use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/remote/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }

    public function testPong()
    {
        $client = static::createClient();
        $client->request('GET', '/remote/pong');
        $content = $client->getResponse()->getContent();
        $serializer = SerializerBuilder::create()->build();
        $message = $serializer->deserialize($content, 'SmartboxSkeletonBundle\Entity\PingMessage', 'json');

        $this->assertSame('Pong', $message->getMessage());
    }
}
