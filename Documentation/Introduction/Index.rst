.. include:: /Includes.rst.txt

.. _introduction:

============
Introduction
============

What does it do?
================

The Mail Routing extension allows you to route emails to different transports based on configuration.
This is particularly useful when you need to send different types of emails through different mail servers
or when you want to test email functionality in a development environment.

Key Features
============

* Route emails to different transports based on configuration
* Choose the transport per site (site setting ``mailer``) or per e-mail (``X-Mail-Transport`` header)
* Support for multiple mail transport configurations
* Seamless integration with TYPO3's mail system

Target Audience
===============

This documentation is written for:

* TYPO3 integrators who want to configure the extension
* Developers who want to understand how the extension works
* System administrators who need to set up mail transports

Related Documentation
===================

* :ref:`Installation <installation>`
* :ref:`Configuration <configuration>`
* :ref:`Usage <usage>` 