<?php

namespace Mfd\Mail\Routing\Event;

use Symfony\Component\Mime\RawMessage;

class BeforeMailerReceivesMailEvent
{
    public function __construct(private RawMessage $message)
    {
    }

    public function getMessage(): RawMessage
    {
        return $this->message;
    }

    public function setMessage(RawMessage $message): void
    {
        $this->message = $message;
    }
}
