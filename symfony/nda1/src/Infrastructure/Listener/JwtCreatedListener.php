<?php

namespace App\Infrastructure\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedListener
{
    public function __invoke(JWTCreatedEvent $createdEvent)
    {
        $payload = $createdEvent->getData();
        $payload['uuid'] = $createdEvent->getUser()->getUuid();
        $createdEvent->setData($payload);
    }
}
