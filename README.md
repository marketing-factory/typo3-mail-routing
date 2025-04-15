# TYPO3 Mail Routing Extension

A TYPO3 CMS extension that enables flexible e-mail transport routing. This extension allows you to control which mail transport is used for sending emails either globally for your entire site or on a per-email basis.

## Features

- Route emails to different transports using the X-Mail-Transport header
- Configure a default transport for a certain site
- Override the default transport on a per-email basis by setting the X-Mail-Transport header
- Seamless integration with TYPO3's mail system
- Support for multiple mail transport configurations
- Easy to extend and customize

## Requirements

- PHP 8.1 or higher
- TYPO3 CMS 13.4.5 or higher

## Installation

1. Install via Composer:
```bash
composer require mfd/typo3-mail-routing
```

2. Include the extension in your TYPO3 installation:
   - Activate the extension in the TYPO3 Extension Manager
   - Or include it in your `composer.json` and run `composer update`

## Configuration

The extension is configured through EXTCONF settings that follow the same conventions as TYPO3's mail configuration (`$GLOBALS['TYPO3_CONF_VARS']['MAIL']`). You can configure these settings in your `config/system/additional.php` file:

```php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mail_routing'] = [
    'transports' => [
        'special_smtp' => [
            'transport' => 'smtp',
            'host' => 'smtp.example.org',
            'port' => 25,
            // ... other SMTP settings
        ],
        'sendmail' => [
            'transport' => 'sendmail',
            'command' => '/usr/sbin/sendmail -bs',
        ],
    ]
    // Add more transport configurations as needed
];
```

Each transport configuration should match the structure expected by TYPO3's mail system. The `default` key specifies which transport to use when no specific transport is requested.

## Development

### Setup Development Environment

1. Clone the repository
2. Install dependencies:
```bash
composer install
```

### Code Quality Tools

The extension includes several code quality tools:

- PHPStan for static analysis
- PHPCS for code style checking
- Rector for automated refactoring

Run PHPStan analysis:
```bash
composer phpstan
```

## License

This extension is licensed under GPL-3.0-or-later.

## Author

- Christian Spoo (christian.spoo@marketing-factory.de)

## Support

For support, please create an issue in the GitHub repository or contact the author directly.