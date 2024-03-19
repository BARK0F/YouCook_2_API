<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutListener
{
    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $event): void
    {
        $uri = $event->getRequest()->query->get('redirect');

        if (!$uri) {
            return;
        }

        $event->setResponse(new RedirectResponse($uri, Response::HTTP_MOVED_PERMANENTLY));
    }
}
