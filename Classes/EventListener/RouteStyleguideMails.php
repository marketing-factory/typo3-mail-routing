<?php

namespace Mfd\Mail\Routing\EventListener;

use Mfd\Mail\Routing\Event\BeforeMailerReceivesMailEvent;
use Symfony\Component\Mime\Email;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Site\Entity\Site;

#[AsEventListener]
class RouteStyleguideMails
{
    public function __invoke(BeforeMailerReceivesMailEvent $event): void
    {
        $request = $GLOBALS['TYPO3_REQUEST'];
        $site = $request->getAttribute('site');

        if (!$site instanceof Site) {
            return;
        }

        $chosenMailer = $site->getSettings()->get('mailer');
        if (is_null($chosenMailer)) {
            return;
        }

        $message = $event->getMessage();
        if ($message instanceof Email) {
            $message->getHeaders()->addHeader('X-Mail-Transport', $chosenMailer);
        }

        $event->setMessage($message);
    }
}
