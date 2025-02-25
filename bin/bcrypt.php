#!/usr/bin/env php
<?php

declare(strict_types=1);

$autoload = realpath(__DIR__ . '/../vendor/autoload.php');
if (! $autoload) {
    // Attempt to locate it relative to the application root
    $autoload = realpath(__DIR__ . '/../../../autoload.php');
}

if (! $autoload) {
    throw new RuntimeException(
        'Unable to locate autoloader. Please run `composer install`.'
    );
}

include $autoload;

$help = <<<EOH
Usage:
  php bcrypt.php <password> [cost]

Arguments:
  <password>      The user's password
  [cost]          The value of the cost parameter of bcrypt.
                  (default is %d)

EOH;

if ($argc < 2) {
    printf($help, 10);
    exit(1);
}

$cost = 10;
if (isset($argv[2])) {
    $cost = $argv[2];
}
printf("%s\n", password_hash($argv[0], PASSWORD_BCRYPT, ['cost' => $cost]));
