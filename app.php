<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use Dk\TestworkLenvendo\CommandRunner;
use My\Commands;

$cr = new CommandRunner($argv);
$cr->register(new Commands\TestCommand())
    ->run();