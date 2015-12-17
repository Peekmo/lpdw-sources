<?php

namespace LpdwBundle\Listener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class TotoListener
{
    public function checkToto(GetResponseEvent $event)
    {
        $tot = $event->getRequest()->query->get('toto');

        if (!is_null($tot)) {
            $event->getRequest()->query->set('tata', $tot);
        }
    }
}
