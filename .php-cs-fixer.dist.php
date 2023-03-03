<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in([
             __DIR__ . '/app',
             __DIR__ . '/config',
             __DIR__ . '/database/factories',
             __DIR__ . '/database/migrations',
             __DIR__ . '/database/seeders',
             __DIR__ . '/routes',
             __DIR__ . '/tests',
         ]);

$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(false)
    ->setRules([
                   '@PSR12' => true,
               ])
    ->setFinder($finder);
