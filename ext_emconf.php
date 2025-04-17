<?php

$EM_CONF['mail_routing'] = [
    'title' => 'TYPO3 mail routing',
    'description' => 'A TYPO3 CMS extension that enables flexible e-mail transport routing. This extension allows you to control which mail transport is used for sending emails either globally for your entire site or on a per-email basis.',
    'category' => 'services',
    'author' => 'Christian Spoo',
    'author_email' => 'christian.spoo@marketing-factory.de',
    'author_company' => 'Marketing Factory Digital GmbH',
    'state' => 'beta',
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.5-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Mfd\\Mail\\Routing\\' => 'Classes/',
        ],
    ],
];
