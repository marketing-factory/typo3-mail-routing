.. include:: /Includes.rst.txt

.. _configuration:

==============
Configuration
==============

Mail Transport Configuration
============================

The extension allows you to configure multiple mail transports. Each transport can be configured
with different settings like SMTP server, port, authentication, etc.

Example Configuration
---------------------

.. code-block:: php

   $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mail_routing']['transports'] = [
       'gmail' => [
           'transport' => 'smtp',
           'host' => 'smtp.gmail.com',
           'port' => 587,
           'encryption' => 'tls',
           'username' => 'your-email@gmail.com',
           'password' => 'your-password',
       ],
   ];

Available Transport Types
-------------------------

* smtp
* sendmail
* null (for testing)

Transport Configuration Options
-------------------------------

.. list-table::
   :header-rows: 1

   * - Option
     - Description
     - Required
   * - transport
     - Type of transport (smtp, sendmail, null)
     - Yes
   * - host
     - SMTP server hostname
     - For SMTP only
   * - port
     - SMTP server port
     - For SMTP only
   * - encryption
     - Encryption method (tls, ssl)
     - No
   * - username
     - Authentication username
     - No
   * - password
     - Authentication password
     - No

Using Different Transports
==========================

The name ``default`` is reserved: it always uses the transport configured in
``$GLOBALS['TYPO3_CONF_VARS']['MAIL']``. Unknown names fall back to it as well.

Per e-mail
----------

Add the ``X-Mail-Transport`` header to your e-mail. The header is removed before sending:

.. code-block:: php

   $email = new \Symfony\Component\Mime\Email();
   $email->getHeaders()->addTextHeader('X-Mail-Transport', 'gmail'); 

Per site
--------

Set the site setting ``mailer`` (``config/sites/<site>/settings.yaml``) to a transport name.
E-mails sent during a request of that site use it, unless the e-mail sets its own header.
There is no site in CLI context, so the default transport is used there.

.. code-block:: yaml

   mailer: gmail
