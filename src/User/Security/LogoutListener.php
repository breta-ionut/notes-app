<?php

declare(strict_types=1);

namespace App\User\Security;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutListener implements EventSubscriberInterface
{
    public function onLogout(LogoutEvent $event): void
    {
        $event->setResponse(new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT));
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [LogoutEvent::class => ['onLogout', 64]];
    }
}
