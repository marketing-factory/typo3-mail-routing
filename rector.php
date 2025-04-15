<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/Classes',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets()
    ->withPreparedSets(deadCode: true, codeQuality: true, codingStyle: true, typeDeclarations: true);
