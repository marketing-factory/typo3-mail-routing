<?php

declare(strict_types=1);

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
    public const TRANSPORT_HEADER = 'X-Mail-Transport';

    public function send(RawMessage $message, ?Envelope $envelope = null): void
    {
        $event = new BeforeMailerReceivesMailEvent($message);
        $this->eventDispatcher?->dispatch($event);
        $message = $event->getMessage();

        $selectedTransport = 'default';
        if ($message instanceof Email) {
            $headers = $message->getHeaders();
            $selectedTransport = $headers->get(self::TRANSPORT_HEADER)?->getBodyAsString() ?: 'default';
            // Internal routing hint, must not leak into the outgoing mail
            $headers->remove(self::TRANSPORT_HEADER);
        }

        $transport = $selectedTransport === 'default' ? null : $this->getCustomTransport($selectedTransport);
        if (!$transport instanceof TransportInterface) {
            parent::send($message, $envelope);
            return;
        }

        $currentTransport = $this->transport;
        $this->transport = $transport;
        try {
            parent::send($message, $envelope);
        } finally {
            $this->transport = $currentTransport;
        }
    }

    private function getCustomTransport(string $key): ?TransportInterface
    {
        $settings = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mail_routing']['transports'][$key] ?? null;
        if (!is_array($settings)) {
            return null;
        }

        return $this->getTransportFactory()->get($settings);
    }
}
