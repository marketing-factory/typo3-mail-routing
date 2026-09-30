.. include:: /Includes.rst.txt

.. _installation:

============
Installation
============

Requirements
============

* TYPO3 13.4.5 or higher (13.4 LTS and 14.x)
* PHP 8.2 or higher

Installation
============

#. Install the extension using Composer:

   .. code-block:: bash

      composer require mfd/typo3-mail-routing

#. Install the extension via the Extension Manager or run:

   .. code-block:: bash

      ./vendor/bin/typo3 extension:install mail_routing

Configuration
=============

After installation, you need to configure the mail transports in your TYPO3 configuration.
See :ref:`Configuration <configuration>` for details.

Next Steps
==========

* :ref:`Configure mail transports <configuration>`
* :ref:`Learn how to use the extension <usage>` 