.. include:: /Includes.rst.txt

.. _usage:

=====
Usage
=====

Basic Usage
===========

The extension integrates seamlessly with TYPO3's mail system. Here's how to use it:

.. code-block:: php

   use TYPO3\CMS\Core\Mail\MailMessage;
   use TYPO3\CMS\Core\Utility\GeneralUtility;

   $mail = GeneralUtility::makeInstance(MailMessage::class);
   $mail
       ->to('recipient@example.com')
       ->from('sender@example.com')
       ->subject('Test Email')
       ->text('This is a test email')
       ->html('<p>This is a test email</p>');

   // Use default transport
   $mail->send();

   // Use specific transport
   $mail->getHeaders()->addTextHeader('X-Mail-Transport', 'gmail');
   $mail->send();

Advanced Usage
=============

Event Handling
-------------

The extension provides events that you can listen to:

* :php:`\Mfd\Mail\Routing\Event\BeforeMailerReceivesMailEvent`

Example of event listener:

.. code-block:: php

   use Mfd\Mail\Routing\Event\BeforeMailerReceivesMailEvent;
   use Symfony\Component\EventDispatcher\EventSubscriberInterface;

   class MyEventListener implements EventSubscriberInterface
   {
       public static function getSubscribedEvents(): array
       {
           return [
               BeforeMailerReceivesMailEvent::class => 'onBeforeMailerReceivesMail',
           ];
       }

       public function onBeforeMailerReceivesMail(BeforeMailerReceivesMailEvent $event): void
       {
           $message = $event->getMessage();
           // Modify the message if needed
       }
   }

Best Practices
=============

* Always configure a default transport
* Use specific transports for different types of emails
* Test your configuration in a development environment first
* Keep sensitive information (passwords) in secure configuration files 