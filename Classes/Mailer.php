<?php

namespace Mfd\Mail\Routing;

use Mfd\Mail\Routing\Event\BeforeMailerReceivesMailEvent;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;
use TYPO3\CMS\Core\Mail\Mailer as BaseMailer;
use TYPO3\CMS\Core\Mail\MailerInterface;

#[Autoconfigure(public: true)]
#[AsAlias(MailerInterface::class, public: true)]
class Mailer extends BaseMailer
{
    public function send(RawMessage $message, ?Envelope $envelope = null): void
    {
        $event = new BeforeMailerReceivesMailEvent($message);
        $this->eventDispatcher->dispatch($event);
        $message = $event->getMessage();

        if ($message instanceof Email) {
            $selectedTransport = $message->getHeaders()->get('X-Mail-Transport')?->getBody();
        }

        $selectedTransport ??= 'default';
        if ($selectedTransport === 'default') {
            parent::send($message, $envelope);
            return;
        }

        $currentTransport = $this->getTransport();
        $transport = $this->getCustomTransport($selectedTransport);

        if ($transport instanceof TransportInterface) {
            $this->transport = $transport;
            parent::send($message, $envelope);
            $this->transport = $currentTransport;
        } else {
            parent::send($message, $envelope);
        }
    }

    private function getCustomTransport(string $key): ?TransportInterface
    {
        if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mail_routing']['mail_transports'][$key])) {
            return null;
        }

        return $this->getTransportFactory()->get(
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mail_routing']['mail_transports'][$key]
        );
    }
}
