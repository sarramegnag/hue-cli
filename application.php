#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Command\DeviceListCommand;
use Symfony\Component\Console\Application;

$application = new Application('Console App', 'v1.0.0');
$application->add(new DeviceListCommand());
$application->run();

// OGW5OBGpRHSBMDDjkNicwbYKDWgjl4J0jjGD8mko
