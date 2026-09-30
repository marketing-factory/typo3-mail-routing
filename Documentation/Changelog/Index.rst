.. include:: /Includes.rst.txt

.. _changelog:

=========
Changelog
=========

All notable changes to this project will be documented in this file.

The format is based on `Keep a Changelog <https://keepachangelog.com/en/1.0.0/>`_,
and this project adheres to `Semantic Versioning <https://semver.org/spec/v2.0.0.html>`_.

[Unreleased]
============

Added
-----

* Initial release of the Mail Routing extension
* Compatibility with TYPO3 14

Changed
-------

* Require PHP 8.2 or higher
* The ``X-Mail-Transport`` header is removed before sending

Fixed
-----

* Restore the original transport if sending fails
* Do not fail without a request (CLI)
* Support for multiple mail transports
* Configuration through TYPO3 backend
* Event system for customizing mail handling

Changed
-------

* None

Deprecated
----------

* None

Removed
-------

* None

Fixed
-----

* None

Security
--------

* None 