<?php

declare(strict_types=1);

namespace Mfd\Mail\Routing\EventListener;

use Mfd\Mail\Routing\Event\BeforeMailerReceivesMailEvent;
use Mfd\Mail\Routing\Mailer;
use Symfony\Component\Mime\Email;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Site\Entity\Site;

#[AsEventListener]
class RouteStyleguideMails
{
    public function __invoke(BeforeMailerReceivesMailEvent $event): void
    {
        $message = $event->getMessage();
        if (!$message instanceof Email) {
            return;
        }

        // Do not overwrite an existing header
        if ($message->getHeaders()->has(Mailer::TRANSPORT_HEADER)) {
            return;
        }

        // No request in CLI context
        $site = ($GLOBALS['TYPO3_REQUEST'] ?? null)?->getAttribute('site');
        if (!$site instanceof Site) {
            return;
        }

        $chosenMailer = $site->getSettings()->get('mailer');
        if (!is_string($chosenMailer) || $chosenMailer === '') {
            return;
        }

        $message->getHeaders()->addTextHeader(Mailer::TRANSPORT_HEADER, $chosenMailer);
    }
}
